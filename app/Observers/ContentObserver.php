<?php

namespace App\Observers;

use App\Models\Content;
use App\Models\Statistic;
use Arr;
use Log;

class ContentObserver
{
    /**
     * Handle the content "created" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function created(Content $content)
    {
        $item = $this->handle();

        $increment_field = $item['increment_field'];
        $statistic_item = Arr::only($item, ['text_editor_id', 'responsible_editor_id']);

        $content->statistic()->create(array_merge($statistic_item, [$increment_field => 1]));
    }

    /**
     * Handle the content "updated" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function updated(Content $content)
    {
        $item = $this->handle();

        $statistic_item = Arr::only($item, ['text_editor_id', 'responsible_editor_id']);
        $statistic_item['time'] = 0;
        $statistic_item['honor'] = 0;
        $statistic_item['headline'] = 0;
        $statistic_item['government'] = 0;
        $increment_field = $item['increment_field'] ?? null;
        if ($increment_field) {
            $statistic_item[$increment_field] = 1;
        }

        $content->statistic()->update($statistic_item);
    }

    /**
     * Pre-processing
     * @return array
     */
    public function handle()
    {
        $request_date = request()->all();
        $increment_field = null;
        $media_id = request()->media_id ?? null;

        switch ($media_id) {
            case Content::TIME;
                $increment_field = 'time';
                break;
            case Content::HONOR;
                $increment_field = 'honor';
                break;
            case Content::GOVERNMENT;
                $increment_field = 'government';
                break;
            case Content::HEADLINE;
                $increment_field = 'headline';
                break;
        }

        return [
            'increment_field' => $increment_field,
            'text_editor_id' => $request_date['text_editor_id'],
            'responsible_editor_id' => $request_date['responsible_editor_id'],
        ];
    }

    /**
     * Handle the content "deleted" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function deleted(Content $content)
    {
        //
    }

    /**
     * Handle the content "restored" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function restored(Content $content)
    {
        //
    }

    /**
     * Handle the content "force deleted" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function forceDeleted(Content $content)
    {
        //
    }
}
