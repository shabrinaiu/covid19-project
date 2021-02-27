<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicResponse extends Model
{
    protected $fillable = [
        'news_date', 'country', 'news_url', 'news_text', 'response_value', 'entried_by'
    ];
}
