<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table    = 'articles';
    protected $fillable = ['id', 'category_id', 'sub_category_id', 'author_id', 'editor_id', 'title', 'title_slug', 'image', 'release_date', 'source_image', 'content', 'tag', 'views', 'status', 'created_at', 'updated_at'];
    protected $casts = [
        'created_at' => 'datetime:d M Y h:i:s',
        'updated_at' => 'datetime:d M Y h:i:s'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function author()
    {
        return $this->belongsTo(userPundi::class, 'author_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }
}
