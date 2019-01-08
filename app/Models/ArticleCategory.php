<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = [
        'article_id', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Article', 'article_id', 'id');
    }
}
