<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    public function articles(){
        return $this->hasMany(Article::class , 'category_id' , 'id')->take(3)->orderBy('created_at','desc');
    }
}
