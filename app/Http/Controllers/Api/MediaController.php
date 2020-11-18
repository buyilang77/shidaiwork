<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medium;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Medium::get(['id','name']);
        return custom_response($media);
    }
}
