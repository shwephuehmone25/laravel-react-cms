<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleComment;
use App\Models\Tag;
use App\Models\Programming;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'like_count',
        'view_count',
    ];

    public function comment()
    {
        return $this->hasMany(ArticleComment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'articles_tags', 'article_id', 'tag_id');
    }

    public function programmings()
    {
        return $this->belongsToMany(Programming::class, 'articles_programmings', 'article_id', 'programming_id');
    }
}
