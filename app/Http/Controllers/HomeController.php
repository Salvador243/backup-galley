<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use App\User;

class HomeController extends Controller
{
    /**
     * Show the index page with all the pictures
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('index');        
    }

    public function search(Request $request){
        $results;
        $type = 1;

        if(isset($_GET['radioSearch']) && $request->input('radioSearch') == 'profiles'){
            $results = User::where('name', 'like', '%'.$request->input('search').'%');
            $type = 0;
        }else{
            $results = Picture::where('title', 'like', '%'.$request->input('search').'%')
            ->orwhere('description', 'like', '%'.$request->input('search').'%');
        }

        return json_encode([$results->paginate(50), $type]);
    }
}
