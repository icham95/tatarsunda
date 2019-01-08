<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function article_categories()
    {
        return $this->hasMany('App\Models\ArticleCategory', 'article_id', 'id');
    }
}
