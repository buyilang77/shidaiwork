<?php

namespace App\Observers;

use App\Models\Manuscript;
use App\Models\Statistic;

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
        $media = $this->getMedia($manuscript->media_id);
        $statistic = auth()->user()->statistic()->whereDate('created_at', now()->toDateString())->first();
        if ($statistic instanceof Statistic) {
            $statistic->decrement($media);
        }
    }

    /**
     * Get media.
     * @param $media_id
     * @return string
     */
    public function getMedia($media_id): string
    {
        $media = null;

        switch ($media_id) {
            case Manuscript::TIMES;
                $media = 'time';
                break;
            case Manuscript::HONOR;
                $media = 'honor';
                break;
            case Manuscript::GOVERNMENT;
                $media = 'government';
                break;
            case Manuscript::HEADLINE;
                $media = 'headline';
                break;
        }

        return $media;
    }
}
