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
        $workflow = $this->resource->workflow;
        return [
            'id'             => $this->resource->id,
            'media_id'       => $this->resource->media_id,
            'is_collaborate' => $this->resource->is_collaborate,
            'media_name'     => $this->resource->media->name,
            'workflow'       => [
                'text_editor'    => $workflow->workflowTextEditor->name,
                'writing_editor' => $workflow->workflowWritingEditor->name ?? null,
                'reviewer'       => $workflow->workflowReviewer->name ?? null,
            ],
            'title'          => $this->resource->title,
            'content'        => $this->resource->content,
            'channel_id'     => $this->resource->channel_id,
            'member_id'      => $this->resource->member_id,
            'source'         => $this->resource->source,
            'article_link'   => $this->resource->article,
            'customer'       => $this->resource->customer,
            'file_list'      => $this->resource->file_list,
            'remark'         => $this->resource->remark,
            'status'         => $workflow->status,
            'created_at'     => $this->resource->created_at->toDateTimeString(),
            'receive_at'     => $workflow->receive_at ?? null,
            'submit_at'      => $workflow->submit_at ?? null,
            'review_at'      => $workflow->submit_at ?? null,
        ];
    }
}
