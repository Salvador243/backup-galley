<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\roles;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ---------------------------------------------
     * Google Login Controller                     |
     * ---------------------------------------------
     *
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider and log in the user.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try{
            $user = Socialite::driver($provider)->user();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            abort(403, 'Unauthorized action.');
            return redirect()->to('/');
        }

        $avatar = '';
        $avatar_url = $user->getAvatar();

        $attributes = [
            'provider' => $provider,
            'provider_id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => isset($attributes['password']) ? $attributes['password'] : bcrypt(Str::random(16))
        ];

        $user = User::where('provider_id', $user->getId() )->first();

        if (!$user){
            try{

                $user = User::create($attributes);
                Controller::makeUserDirectories($user->id);
                Controller::usuario($user->id);

                //Download picture in temporal directory
                $avatar = Controller::downloadAvatar($avatar_url, $user->id);

                //update the path of the image
                $user->img_name = $avatar->name;
                $user->save();
                
            }catch (ValidationException $e){
                if(file_exists($avatar->path))
                    unlink($avatar->path);

                return redirect()->to('/auth/login');
            }
        }

        $this->guard()->login($user);
        return redirect()->to($this->redirectTo);
    }
}
