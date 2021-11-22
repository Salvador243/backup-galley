<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Auth;

class Profile_EditController extends Controller
{
   public function edit($user){
      $data = User::where('email','=', $user)->get();
      return view('edit_profile')->with([
        'user' => $data,
    ]);
  }

  public function update(Request $datos){
    $modify = $datos->all();
    $modify = request()->except(['_token','_method']);
    $id = Auth::user()->id;
    $prev = Auth::user()->img_name;        



    $image_name = '';
    if ($datos->hasFile('img_name')) {
        if(Auth::user()->img_name){
            unlink("storage/uploads/user$id/$prev");
        }
        $image = $datos->file('img_name');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'storage/uploads/user'.$id;
        $image->move($destinationPath, $image_name);
        $modify['img_name'] = $image_name;
    }

/*    if($datos->signature == null){
        DB::table('users')
        ->where('email','=',$datos->email)
        ->update(['enableSignature' => 0,]);
    }else{
        DB::table('users')
        ->where('email','=',$datos->email)
        ->update(['enableSignature' => 1,]);
    }*/
    (new \App\User)->where('email','=',$modify['email'])->update($modify);

    return redirect()->route('Pdetails',$datos->email);
}
}
