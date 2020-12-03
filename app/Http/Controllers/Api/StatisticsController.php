<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticsResource;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $item = Statistic::select([
            '*',
            DB::raw('SUM(time) as time_sum'),
            DB::raw('SUM(honor) as honor_sum'),
            DB::raw('SUM(government) as government_sum'),
            DB::raw('SUM(headline) as headline_sum'),
        ])->with(['user:id,name,username'])
            ->where('created_at', '<', Carbon::now()->toDateString() . ' 14:00:00')
            ->where('created_at', '>', Carbon::yesterday()->toDateString() . ' 14:00:00')
            ->groupBy('user_id')->orderByDesc('id')->get([]);
        return custom_response(StatisticsResource::collection($item));
    }
}
