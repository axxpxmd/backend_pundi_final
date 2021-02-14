<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_category';
    protected $fillable = ['id', 'category_id', 'n_sub_category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
