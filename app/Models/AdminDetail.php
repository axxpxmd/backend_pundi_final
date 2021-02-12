<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Models
use App\User;

class AdminDetail extends Model
{
    protected $table = 'admin_details';
    protected $fillable = ['id', 'admin_id', 'full_name', 'email', 'phone', 'photo'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public static function getDataPengguna($id)
    {
        $data = AdminDetail::join('admins', 'admin_details.admin_id', '=', 'admins.id')
            ->where('admin_details.id', $id)
            ->first();

        return $data;
    }
}
