<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Picture extends Model
{

    protected $fillable = [
        'user_id', 'img_name', 'title', 'description',
    ];

    protected $appends = [
        'image',
    ];

    /**
     * Model's relationships
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getImageAttribute(){
        return '/storage/uploads/user'.$this->user_id.'/pictures/'.$this->img_name;
    }

}
