<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory , SoftDeletes;

    public function article(){
        return $this->belongsTo(Article::class , 'article_id' , 'id');
    }
    public function viewer(){
        return $this->belongsTo(Viewer::class , 'viewer_id' , 'id');
    }
}
