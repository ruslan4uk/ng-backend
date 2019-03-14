<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;

use Socialite;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout () 
    {
        Auth::logout();
        return redirect($this->redirectTo);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {

        if($provider == 'vkontakte' or $provider == 'facebook')
        {

            return Socialite::with($provider)->redirect();
    
        }
        abort(404);
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {

        //dd($provider);

        $oAuthUser = Socialite::driver($provider)->stateless()->user();

        $email = Str::lower($oAuthUser->getEmail());
        $user = User::where('email', $email)->first();
        if($user)
        {
            Auth::login($user, true);
            return redirect($this->redirectTo);
        } else {
            //$request->session()->flash('status', 'Перед авторизацией через соц.сети необходимо <a href="">зарегистрироваться</a>');
            return redirect()->back()->with('error','Перед авторизацией через соц.сети необходимо <a href="">зарегистрироваться</a>');

        }

        
    }
}
