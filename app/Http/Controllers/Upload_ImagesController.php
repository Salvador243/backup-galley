<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Picture;

class Upload_ImagesController extends Controller
{
    public function upload(){
        return view('upload_images');
    }

    public function save(Request $request){
        $id = Auth::user()->id;        
        
        $image_name = '';
        if ($request->hasFile('img_name')) {
            $image = $request->file('img_name');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'storage/uploads/user'.$id.'/pictures';
            $image->move($destinationPath, $image_name);
        } else {
            dd('Request Has No File');
        }

        Picture::create([
            'user_id' => $id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'img_name' => $image_name,
        ]);
    
        return view('upload_images');
    }
}
