<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'text',
    ];

    protected $hidden = [
        'deleted_at',
        'issue_id',
        'comment_id',
    ];

    public $timestamps = false;

    public function comment(): HasOne
    {
        return $this->hasOne($this);
    }
}
