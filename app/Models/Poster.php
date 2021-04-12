<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $table = 'posters';
    protected $fillable = ['id', 'poster', 'created_at', 'updated_at'];
}
