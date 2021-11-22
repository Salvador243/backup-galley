<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'picture_id', 'comment',
    ];

    /**
     * Model's relationships
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function picture(){
        return $this->belongsTo(Picture::class);
    }
}
