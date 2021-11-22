<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class PictureDetailsController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showView($id)
    {
        $picture = Picture::where('id', $id)->with('user')->first();
        $user = User::where('id', $picture->user_id)->first();
        $comments = Comment::where('picture_id', $id)->with('user')
            ->orderBy('created_at', 'desc')->get();
        return view('picture_details')->with([
            'picture' => $picture,
            'upload_user' => $user,
            'comments' => $comments,
        ]);
    }
    
    public function addComment(Request $request)
    {
        Comment::create([
            'user_id' => $request->input('user_id'),
            'picture_id' => $request->input('picture_id'),
            'comment' => $request->input('comment'),
        ]);
        
        echo json_encode(Comment::where('picture_id', $request->input('picture_id'))
            ->with('user')->orderBy('created_at', 'desc')->get());
    }
    
    public function delete($id){
        $picture = Picture::findOrFail($id);
        unlink(substr($picture->image, 1));
        $picture->delete();
        return back();
    }
}
