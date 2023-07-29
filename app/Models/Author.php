<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class Author extends Authenticatable
{
    use HasFactory , SoftDeletes , HasRoles , HasApiTokens;

    public function user(){
        return $this->morphOne(User::class , 'actor' , 'actor_type' , 'actor_id' , 'id');
    }

    public function articles(){
        return $this->hasMany(Article::class , 'author_id' , 'id');
    }

    public function getFullNameAttribute(){
        return $this->user->first_name . " " . $this->user->last_name;
    }

    public function getImagesAttribute(){
        return $this->user->image;
    }
}