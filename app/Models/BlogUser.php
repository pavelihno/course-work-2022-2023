<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogUser extends Model
{
    use HasFactory;

    protected $table = 'users_blogs';
    protected $fillable = [
        'blog_id',
        'user_id'
    ];
}
