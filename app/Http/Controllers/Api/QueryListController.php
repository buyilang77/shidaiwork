<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manuscript;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use QL\QueryList;

class QueryListController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|bool
     */
    public function query(Request $request): JsonResponse
    {
        $request_data = $request->validate([
            'article_link' => 'required|url',
        ]);
        $url = $request_data['article_link'];
        $_host = parse_url($url, PHP_URL_HOST);  //获取主机名
        if($_host !== 'mp.weixin.qq.com') return false;  //不是来自微信文章

        $html = file_get_contents($url);
        if(empty($html)) return false;
        $html = str_replace("<!--headTrap<body></body><head></head><html></html>-->", "", $html);  //去除微信干扰元素!!!否则乱码
        preg_match("/var msg_cdn_url = \".*\"/", $html, $matches);   //获取微信封面图
        $rules = array(   //设置QueryList的解析规则
            'content' => array('#js_content', 'html'),  //文章内容
            'title' => array('#activity-name', 'text'),  //文章标题
            'author'=> array('.rich_media_meta_text:eq(1)','text'),  //作者
            'account_name' => array('#js_profile_qrcode .profile_nickname','text'),  //公众号
            'account_en_name' => array('#js_profile_qrcode .profile_meta:eq(0) .profile_meta_value','text'),  //公众号英文标识
        );
        $result = QueryList::html($html)->rules($rules)->query()->getData();   //执行解析
        if(empty($result)) return false;  //解析失败
        $result['title_crc'] = sprintf("%u", crc32($result['title']));   //标题crc
        $result['url_crc'] = sprintf("%u", crc32($url));   //url-crc
        $pattern = '/<img([^>]*)data-src\s*=\s*([\' "])([\s\S]*?)([^>]*)/';    //正则替换内容中的图片链接
        $result['content'] = preg_replace($pattern, '<img$1src=$2$3$4', $result['content']);

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function download(Request $request): JsonResponse
    {
        $image_url = $request->validate(['image_url' => 'required|url']);
        $date = now()->toDateString();
        $image_path = 'images/' . $date . '/' . Str::random(40). '.jpeg';

        try {
            $client = new Client(['verify' => false]);  //忽略SSL错误
            $response = $client->get($image_url['image_url']);
            $image_data = $response->getBody()->getContents();
            Storage::disk('local')->put('public/' . $image_path, $image_data);
        } catch (GuzzleException $exception) {
            Log::error($exception->getMessage());
        }
        return custom_response(['image_path' => $image_path]);
    }
}
