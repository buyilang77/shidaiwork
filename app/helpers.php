<?php

use Illuminate\Http\JsonResponse;

/**
 * @param $data
 * @param string $message
 * @return JsonResponse
 */
function custom_response($data = null, string $message = null): JsonResponse
{
    $item = [];
    if (!empty($message)) {
        $message = trans('message.' . $message);
        $item['message'] = $message;
    }
    if (!empty($data)) {
        $item['data'] = $data;
    }

    return response()->json($item);
}
