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
        try{
            $fb_user = Socialite::driver('facebook')->stateless()->user();
            }
        catch(Exception $e)
            {
             return redirect()->to('/login');
            }

        if ($fb_user == User::where('email', $fb_user->getEmail())->first()) 
        {
            return redirect()->to('/home');
        }
        else {
        $user = new User();
        $user->updateOrCreate([
            'name' => $fb_user->getName(),
            'email' => $fb_user->getEmail(),
            'avatar' => $fb_user->getAvatar()
        ]);

        Auth::login($user, true);
        return redirect()->to('/home');
        }
    }
}




