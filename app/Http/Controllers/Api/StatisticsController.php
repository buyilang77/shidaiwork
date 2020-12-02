<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticResource;
use App\Models\Role;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StatisticsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $statistics = Statistic::with(['user:id,name,username'])->orderByDesc('id')->get();
        $dates = $statistics->map(fn($item) => $item->created_at->toDateString())->unique()->toArray();
        $item = [];
        foreach ($statistics as $statistic) {
            $result = Arr::where(array_values($dates), fn ($item) => $statistic->created_at->toDateString() === $item);
            $item[key($result)]['date'] = $statistic->created_at->toDateString();
            $count = $statistic->government + $statistic->headline + $statistic->honor + $statistic->time;
            $item[key($result)][$statistic->user->username] = $count;
        }
        return custom_response($item);
    }
}
