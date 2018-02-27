<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;
use Blog\Movie;
use Blog\Categorie;
use Blog\Actor;

class Actor extends Model
{
    public function user() {
        return $this->belongsTo('Blog\User');
    }

    public function movies() {
        return $this->belongsToMany('Blog\Movie');
    }
}
