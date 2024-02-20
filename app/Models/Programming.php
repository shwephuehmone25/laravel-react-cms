<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;

class Programming extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_programmings', 'programming_id', 'article_id');
    }
}
