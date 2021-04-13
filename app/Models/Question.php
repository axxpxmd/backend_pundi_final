<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['id', 'read_by', 'email', 'name', 'question', 'status', 'created_at', 'updated_at'];
}
