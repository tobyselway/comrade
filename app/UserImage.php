<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{

    protected $fillable = [
        'path', 'width', 'height', 'location'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
