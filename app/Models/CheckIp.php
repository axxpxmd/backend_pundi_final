<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIp extends Model
{
    protected $table = 'check_ip';
    protected $fillable = ['id', 'article_id', 'ip', 'created_at', 'updated_at'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
