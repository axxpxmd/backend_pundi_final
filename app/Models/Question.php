<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['id', 'read_by', 'email', 'name', 'question', 'status', 'created_at', 'updated_at'];

    public function readBy()
    {
        return $this->belongsTo(User::class, 'read_by')->withDefault([
            'username' => '-'
        ]);
    }
}
