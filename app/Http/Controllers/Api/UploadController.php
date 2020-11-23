<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $image_path = $request->file('image')->store('public/images');
        return custom_response(['image_path' => $image_path]);
    }

    public function file(Request $request)
    {
        $date = now()->toDateString();
        $image_path = $request->file('file')->store('public/file/' . $date);
        return custom_response(['file_path' => $image_path]);
    }
}
