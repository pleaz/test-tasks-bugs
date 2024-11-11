<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['path', 'method', 'request'];

    const UPDATED_AT = null;
}
