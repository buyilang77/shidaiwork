<?php

namespace App\Observers;

use App\Models\Content;
use App\Models\Statistic;

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
//        $request_date = request()->all();
//
//        $increment_field = null;
//        $media_id = request()->media_id ?? null;
//        if ($media_id) {
//            if ($media_id === 1) {
//                $increment_field = 'time';
//            } elseif ($media_id === 2) {
//                $increment_field = 'honor';
//            } elseif ($media_id === 3) {
//                $increment_field = 'government';
//            } elseif ($media_id === 4) {
//                $increment_field = 'headline';
//            }
//        }

//        $statistic_item = [
//            'text_editor_id' => $request_date['text_editor_id'],
//            'responsible_editor_id' => $request_date['responsible_editor_id'],
//        ];
//
//        $statistic = Statistic::where($statistic_item)->first();
//        // update if it exists, otherwise create a new one
//        if ($statistic instanceof Statistic) {
//            $statistic->increment($increment_field);
//        } else {
//            $statistic_item[$increment_field] = 1;
//            Statistic::create($statistic_item);
//        }
    }

    /**
     * Handle the content "updated" event.
     *
     * @param  \App\Models\Content  $content
     * @return void
     */
    public function updated(Content $content)
    {
        //
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
