<?php

namespace App\Events;

use App\Models\Manuscript;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ManuscriptStatistics
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $manuscript;

    /**
     * Create a new event instance.
     *
     * @param Manuscript $manuscript
     */
    public function __construct(Manuscript $manuscript)
    {
        $this->manuscript = $manuscript;
    }
}
