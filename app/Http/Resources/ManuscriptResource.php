<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManuscriptResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->resource->id,
            'media_id'     => $this->resource->media_id,
            'media_name'   => $this->resource->media->name,
            'workflow'     => [
                'text_editor'    => $this->resource->workflow->workflowTextEditor->name,
                'writing_editor' => $this->resource->workflow->workflowWritingEditor->name ?? null,
                'reviewer'       => $this->resource->workflow->workflowReviewer->name ?? null,
            ],
            'title'        => $this->resource->title,
            'content'      => $this->resource->content,
            'channel_id'   => $this->resource->channel_id,
            'member_id'    => $this->resource->member_id,
            'source'       => $this->resource->source,
            'article_link' => $this->resource->article,
            'customer'     => $this->resource->customer,
            'file_list'    => $this->resource->file_list,
            'remark'       => $this->resource->remark,
            'status'       => $this->resource->workflow->status,
            'created_at'   => $this->resource->created_at->toDateTimeString(),
        ];
    }
}
