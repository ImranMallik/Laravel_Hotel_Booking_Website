<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blogcat_id', 'id');
    }

    public function userblog()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
