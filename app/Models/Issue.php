<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    /** @use HasFactory<\Database\Factories\IssueFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'reporter',
        'tester',
        'executor',
        'status',
        'type',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public $timestamps = false;

    const STATUS_PAUSE = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_TESTING = 3;
    const STATUS_RELEASE = 4;

    const TYPE_TASK = 1;
    const TYPE_BUG = 2;

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
