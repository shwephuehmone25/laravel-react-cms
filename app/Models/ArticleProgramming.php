<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleProgramming extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'programming_id',
    ];
}
