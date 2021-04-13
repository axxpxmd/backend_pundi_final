<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments1';
    protected $fillable = ['id', 'article_id', 'user_id', 'content', 'status', 'created_at', 'updated_at'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
