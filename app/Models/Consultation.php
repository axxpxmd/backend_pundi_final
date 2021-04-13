<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations';
    protected $fillable = ['id', 'read_by', 'email', 'name', 'consultation', 'status', 'created_at', 'updated_at'];
}
