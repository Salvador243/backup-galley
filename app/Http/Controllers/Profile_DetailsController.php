<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\User;


class Profile_DetailsController extends Controller
{
    public function profiles($id){        
        $data = User::where('id',$id)->with('pictures')->first();
        return view('profile_details')->with([
            'data' => $data,
        ]);
    }

    public function details(){
        $data = User::where('id', Auth::user()->id)->with('pictures')->first();
        
        return view('profile_details')->with([
            'data' => $data,
        ]);
    }
}