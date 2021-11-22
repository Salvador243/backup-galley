<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'img_name', 'password', 'provider', 'provider_id',
        'enableSignature', 'signature',
    ];

    protected $appends = [
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Accessor to set the value in the avatar attribute
    public function getAvatarAttribute(){
        return $this->img_name 
        ? '/storage/uploads/user'.$this->id.'/'.$this->img_name 
        : '/storage/default_user.png';
    }
    
    /**
     * Model's relationships
     */
    public function pictures(){
        return $this->hasMany(Picture::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * Role's functions
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 404);
        return true;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->$role) {
                    return true;
                }
            }
        } else {
            if ($this->$roles) {
                return true;
            }
        }
        return false;
    }
}
