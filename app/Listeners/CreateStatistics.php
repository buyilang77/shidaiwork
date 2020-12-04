<?php

namespace App\Listeners;

use App\Events\ManuscriptStatistics;
use App\Models\Manuscript;
use App\Models\Statistic;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateStatistics implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ManuscriptStatistics $event
     * @return void
     */
    public function handle(ManuscriptStatistics $event)
    {
        $media = $this->getMedia($event->manuscript->media_id);
        $statistic = new Statistic([$media => 1]);
        $statistic->user()->associate(auth()->user());
        $statistic->manuscript()->associate($event->manuscript);
        $statistic->save();
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
