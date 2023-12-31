<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory , SoftDeletes;

    public function category(){
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }
    public function author(){
        return $this->belongsTo(Author::class , 'author_id' , 'id');
    }
    public function comments(){
        return $this->hasMany(Comment::class , 'article_id' , 'id');
    }
}