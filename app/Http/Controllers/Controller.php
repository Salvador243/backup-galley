<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getFormat($name){
        return substr($name, strpos($name, '.'));
    }

    public function makeUserDirectories($id){
        $path = 'storage/uploads/user'.$id.'/pictures';
        $tmp = '';
        foreach(explode('/', $path) as $dir){
            $tmp .= $dir;
            if(!file_exists($tmp))
                mkdir($tmp);
            $tmp .= '/';
        }
    }

    public function downloadAvatar($url, $user_id){
        $ch = curl_init($url);
        $file_name = time().'.jpg';
        $save_loc = 'storage/uploads/user'.$user_id.'/'.$file_name;
        $fp = fopen($save_loc, 'wb');
  
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);

        fclose($fp);

        return (object) [
            'name' => $file_name, 
            'path' => $save_loc,
        ];
    }

    public function moveAvatar($avatar, $id){
        rename($avatar->path, 'storage/uploads/user'.$id.'/'.$avatar->name);
    }
    public function usuario($id){
        User::find($id)->assignRole('user');
        User::find($id)->givePermissionTo('edit profile');
    }
}
