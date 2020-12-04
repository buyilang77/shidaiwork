<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // 采编
    public const TEXT_EDITOR = 1;
    // 文编
    public const WRITING_EDITOR = 2;
    // 高级文编
    public const ADVANCED_EDITOR = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'roles'             => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * @inheritDoc
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return HasMany
     */
    public function manuscript(): HasMany
    {
        return $this->hasMany(Manuscript::class);
    }

    /**
     * Workflow of the text editor.
     * @return HasMany
     */
    public function workflowTextEditor(): HasMany
    {
        return $this->hasMany(WorkflowManuscript::class, 'text_editor_id');
    }

    /**
     * Workflow of the text editor.
     * @return HasMany
     */
    public function workflowWritingEditor(): HasMany
    {
        return $this->hasMany(WorkflowManuscript::class, 'writing_editor_id');
    }

    /**
     * Statistics.
     * @return HasMany
     */
    public function statistic(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }
}
