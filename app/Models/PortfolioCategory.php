<?php

namespace App\Models;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    protected $guarded = ['id'];
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }
}
