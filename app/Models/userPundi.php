<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userPundi extends Model
{
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'password', 'firs_name', 'last_name', 'photo', 'bio', 'no_telp', 'facebook', 'twitter', 'instagram', 'birth_date', 'gender'];
}
