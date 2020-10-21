<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
    use HasFactory;

    public const TIME = 1;
    public const HONOR = 2;
    public const GOVERNMENT = 3;
    public const HEADLINE = 4;

    protected $fillable = ['title', 'content', 'article_link'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function textEditor()
    {
        return $this->belongsTo(TextEditor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsibleEditor()
    {
        return $this->belongsTo(ResponsibleEditor::class);
    }

    /**
     * @return HasOne
     */
    public function statistic(): HasOne
    {
        return $this->hasOne(Statistic::class);
    }

    /**
     * 为数组 / JSON 序列化准备日期。
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
