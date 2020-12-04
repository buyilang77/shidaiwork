<?php

namespace App\Observers;

use App\Models\Manuscript;
use App\Models\Statistic;

class ManuscriptObserver
{

    /**
     * Handle the content "deleted" event.
     *
     * @param Manuscript $manuscript
     * @return void
     * @throws \Exception
     */
    public function deleted(Manuscript $manuscript)
    {
        $condition = [
            'user_id'       => auth()->user()->id,
            'manuscript_id' => $manuscript->id,
        ];
        Statistic::where($condition)->delete();
    }
}
