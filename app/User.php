<?php

namespace App;

use App\Models\AdminDetail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = 'admins';
    protected $fillable = ['username', 'password'];
    protected $hidden = ['password',];

    public function adminDetail()
    {
        return $this->hasMany(AdminDetail::class, 'admin_id', 'id');
    }
}
