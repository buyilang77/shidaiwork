<?php

namespace App\Observers;

use App\Events\ManuscriptStatistics;
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

    /**
     * Handle the event.
     *
     * @param $media_id
     * @return void
     */
    public function handle($media_id)
    {
        $media = $this->getMedia($media_id);
        $statistic = auth()->user()->statistic()->whereDate('created_at', now()->toDateString())->first();
        if ($statistic instanceof Statistic) {
            $statistic->increment($media);
        } else {
            auth()->user()->statistic()->create([$media => 1]);
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
