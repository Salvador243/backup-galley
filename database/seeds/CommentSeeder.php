<?php

use Illuminate\Database\Seeder;
use App\User;
use APP\Picture;
use App\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = 15;
        $users = User::all();
        $pictures = Picture::all();

        for($i = 0; $i < $comments; $i++){
            $attributes = [
                'user_id' => $users[rand(0, count($users)-1)]->id,
                'picture_id' => $pictures[rand(0, count($pictures)-1)]->id,
                'comment' => Str::random(rand(200, 400)),
            ];
            Comment::create($attributes);
        }
    }
}
