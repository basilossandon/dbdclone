<?php

namespace App\Http\Controllers\Auth;
use Socialite;
use Exception;
use Auth;
use App\User; 
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout () {
    //logout user
    auth()->logout();
    // redirect to homepage
    return redirect('/');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $fb_user = Socialite::driver('facebook')->stateless()->user();

        $user = User::storeOrUpdate($fb_user);

        Auth::login($user, true);
        return redirect()->to('/home');
    }
}





