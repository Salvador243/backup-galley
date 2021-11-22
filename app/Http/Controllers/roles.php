<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class roles extends BaseController
{
    public function createRoles(){
        $role1 = Role::create(['name' => 'user']);
        $role2 = Role::create(['name' => 'admin']);
    
        $permission1 = Permission::create(['name' => 'edit profile']);

        $role1->givePermissionTo($permission1);
        $permission1->assignRole($role1, $role2);

//        $user = User::where('email','=','salvador243gm@gmail.com')->first();
//        $user->assignRole('admin');
//        $user->givePermissionTo('edit profile');
//        $role = Role::create(['name' => 'Super Admin']);
//        $user = User::where('email','=','salvador243gm@gmail.com')->first();
//        $user->assignRole('admin');
    }

    public function darRoles(){
        $user = User::where('email','=','salvador243gm@gmail.com')->first();
        $user->assignRole('admin');
        $user->givePermissionTo('edit profile');
    }
} 