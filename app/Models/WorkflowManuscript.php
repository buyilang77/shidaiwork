<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkflowManuscript extends BaseModel
{
    use HasFactory;

    public const STATUS_REVIEW = 2;
    public const STATUS_SUCCESS = 4;

    /**
     * Workflow of the text editor.
     * @return BelongsTo
     */
    public function workflowTextEditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'text_editor_id');
    }

    /**
     * Workflow of the text editor.
     * @return BelongsTo
     */
    public function workflowWritingEditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'writing_editor_id');
    }
}
