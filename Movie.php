<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function user() {
        return $this->belongsTo('Blog\User');
    }

    public function actors() {
        return $this->belongsToMany('Blog\Actor');
    }
}
