<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table    = 'articles';
    protected $fillable = ['id', 'category_id', 'sub_category_id', 'author_id', 'editor_id', 'title', 'title_slug', 'images', 'source_image', 'content', 'tag', 'views', 'status', 'created_at', 'updated_at'];

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
