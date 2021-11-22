<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Picture;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urls = [
            'https://images.unsplash.com/photo-1627631498534-f0e7bf0db55d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1349&q=80',
            'https://images.unsplash.com/photo-1627635174808-34b5172f815a?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1489&q=80',
            'https://images.unsplash.com/photo-1627476517425-d43c87b32eea?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=749&q=80',
            'https://images.unsplash.com/photo-1627736610072-fc606c63d5f5?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0fHx8ZW58MHx8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60',
            'https://images.unsplash.com/photo-1627727240072-ca5fb38e1536?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=401&q=80',
            'https://images.unsplash.com/photo-1627531937355-be59a1935885?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80',
        ];

        $user = User::where('email', 'test@es.es')->first();

        foreach($urls as $url){
            $attributes = [
                'user_id' => $user->id,
                'path' => $url,
                'title' => Str::random(10),
                'description' => Str::random(50),
            ];

            Picture::create($attributes);
        }
    }
}
