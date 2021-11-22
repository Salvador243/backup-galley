<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;


class EditPolicy
{
    use HandlesAuthorization;
    
    public function validation(?User $user, $picture)
    {
        if(Auth::check()){
            if($user->id == $picture || $user->hasRole('admin')){
                return true;
            }else{
                return false;
            }
        }

    }
}