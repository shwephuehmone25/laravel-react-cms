<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_tags', 'tag_id', 'programming_id');
    }
}
