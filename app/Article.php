<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected  $fillable = [
        'title', 'content', 'rating', 'status', 'user_id', 'author'
    ];
}
