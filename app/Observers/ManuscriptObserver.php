<?php

namespace App\Observers;

use App\Models\Manuscript;
use App\Models\Statistic;
use Arr;
use Log;

class ManuscriptObserver
{

    /**
     * Handle the content "deleted" event.
     *
     * @param \App\Models\Manuscript $manuscript
     * @return void
     */
    public function deleted(Manuscript $manuscript)
    {
        $field = $this->handle($manuscript->media_id);
        $statistic = auth()->user()->statistic()->whereDate('created_at', now()->toDateString())->first();
        $statistic->decrement($field);
    }
}
