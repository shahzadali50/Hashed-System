<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    protected $fillable = ['name', 'email', 'phone', 'status', 'assigned_to', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
