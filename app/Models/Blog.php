<?php

namespace App\Models;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
