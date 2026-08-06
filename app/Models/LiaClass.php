<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiaClass extends Model
{
    protected $table = 'classes';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
}
