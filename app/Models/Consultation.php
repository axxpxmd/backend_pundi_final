<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $table = 'consultations';
    protected $fillable = ['id', 'read_by', 'email', 'name', 'consultation', 'status', 'created_at', 'updated_at'];

    public function readBy()
    {
        return $this->belongsTo(User::class, 'read_by')->withDefault([
            'username' => '-'
        ]);
    }
}
