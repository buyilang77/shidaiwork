<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Manuscript extends BaseModel
{
    use HasFactory;

    public const TIMES = 1;
    public const HONOR = 2;
    public const GOVERNMENT = 3;
    public const HEADLINE = 4;

    protected $casts = ['file_list' => 'array'];

    /**
     * @return BelongsTo
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Medium::class);
    }

    /**
     * @return BelongsTo
     */
    public function textEditor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function writingEditor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne
     */
    public function statistic(): HasOne
    {
        return $this->hasOne(Statistic::class);
    }

    /**
     * @return HasOne
     */
    public function workflow(): HasOne
    {
        return $this->hasOne(WorkflowManuscript::class);
    }
}
