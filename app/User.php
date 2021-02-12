<?php

namespace App;

use App\Models\AdminDetail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password',];

    public function adminDetail()
    {
        return $this->hasMany(AdminDetail::class, 'admin_id', 'id');
    }
}
