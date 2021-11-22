<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Tester upload pictures user
        $attributes = [
            'provider' => 'laravel',
            'name' => 'Test User',
            'email' => 'test@es.es',
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=334&q=80',
            'enableSignature' => 1,
            'signature' => 'Para trabajar basta estar convencido de una cosa: que trabajar es menos aburrido que divertirse. Charles Baudelaire',
            'password' => Hash::make('password'),
        ];
        User::create($attributes);

        //Teste comments users
        for($i = 0; $i < 5; $i++){
            $name = 'User'.strval(rand(0, 9999));
            $enableSignature = rand(0, 1);
            $signature = $enableSignature ? Str::random(rand(15, 30)) : NULL;
            $attributes = [
                'provider' => 'laravel',
                'name' => $name,
                'email' => $name.'@es.es',
                'avatar' => 'https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png',
                'enableSignature' => $enableSignature,
                'signature' => $signature,
                'password' => Hash::make('password'),
            ];
            User::create($attributes);
        }
    }
}
