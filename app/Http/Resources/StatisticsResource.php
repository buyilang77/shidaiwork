<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $sum = $this->resource->government_sum + $this->resource->headline_sum + $this->resource->honor_sum + $this->resource->time_sum;
        return [
            'sum'        => $sum,
            'name'       => $this->resource->user->name,
            'created_at' => $this->resource->created_at->toDateString(),
        ];
    }
}
