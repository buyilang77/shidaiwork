<?php

namespace App\Observers;

use App\Models\Manuscript;
use App\Models\Statistic;
use Arr;
use Log;

class ManuscriptObserver
{
    /**
     * Handle the content "created" event.
     *
     * @param \App\Models\Manuscript $manuscript
     * @return void
     */
    public function created(Manuscript $manuscript)
    {
        $field = $this->handle($manuscript->media_id);

        $statistic = Statistic::whereDate('created_at', now()->toDateString())->first();
        if ($statistic instanceof Statistic) {
            $statistic->increment($field);
        } else {
            Statistic::create([
                'user_id' => auth()->user()->id,
                $field    => 1,
            ]);
        }
    }

    /**
     * Pre-processing
     * @param $media_id
     * @return string
     */
    public function handle($media_id): string
    {
        $increment_field = null;

        switch ($media_id) {
            case Manuscript::TIMES;
                $increment_field = 'time';
                break;
            case Manuscript::HONOR;
                $increment_field = 'honor';
                break;
            case Manuscript::GOVERNMENT;
                $increment_field = 'government';
                break;
            case Manuscript::HEADLINE;
                $increment_field = 'headline';
                break;
        }

        return $increment_field;
    }

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
