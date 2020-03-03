<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    protected $fillable = [
        'user_id', 'post_id', 'score'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

}
