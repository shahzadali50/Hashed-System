<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $guarded = ['id'];
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
