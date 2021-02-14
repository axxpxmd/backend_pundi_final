<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudulSection extends Model
{
    protected $table = 'homepage_title';
    protected $fillable =  ['id', 'card1', 'card2', 'card3', 'card4'];
}
