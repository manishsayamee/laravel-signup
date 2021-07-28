<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;    


class socialMediaLoginController extends Controller

{
    public function redirectToGoogle()
     {
        return Socialite::driver('google')->redirect();
        
        }

        // Google callback

    public function handleGoogleCallback(){

        $user = Socialite::driver('google')->user();
        // dd($user->user->given_name);     re
        // dd($user->user['given_name']);/

        $this->_registerOrloginUser($user, 'google');
        return redirect()->route('home');
    }

    
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
        }

    public function handleFacebookCallback(){

        $user = Socialite::driver('facebook')->user();
        $this->_registerOrloginUser($user, 'facebook');
        return redirect()->route('home');
    }

    
    public function redirectToTwitter()
        {
            return Socialite::driver('twitter')->redirect();
        }

    
        public function handleTwitterCallback(){

        $user = Socialite::driver('twitter')->user();
        $this->_registerOrloginUser($user, 'twitter');
        return redirect()->route('home');
    }

    
    public function redirectToGithub()
    {

        return Socialite::driver('github')->redirect();       
        }

    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();

        $this->_registerOrloginUser($user,'github');
        return redirect()->route('home');
    }
    
    public function redirectToLinkedin()
    {

        return Socialite::driver('linkedin')->redirect();       
        }

    public function handleLinkedinCallback(){
        $user = Socialite::driver('linkedin')->user();
        $this->_registerOrloginUser($user, 'linkedin');
        return redirect()->route('home');
    }

    protected function _registerOrLoginUser($data, $provider) {
        // dd($data);
        $user = User::where('email', '=', $data->email)->first();
        if (!$user){
            $user = new User();
            $user->email = $data->email;
            $user->provider = $data->id;
            $user->avatar = $data->avatar;
            
            switch ($provider){
                case 'google':                    
                    $user->firstname = $data->user["given_name"];
                    $user->lastname = $data->user["family_name"];
                    break;

                case 'linkedin':
                    $user->firstname = $data->first_name;
                    $user->lastname = $data->last_name;
                    break;
                case 'github':
                    $fullname = $data->name;
                    $fullname = explode(' ', $fullname);
                    $user->firstname = $fullname[0];
                    $user->lastname = end($fullname);

                    break;
                case 'twitter':
                    $fullname = $data->name;
                    $fullname = explode(" ", $fullname);
                    $user->firstname = $fullname[0];
                    $user->lastname = end($fullname);
                default:
                    return redirect()->route('home');

            }
            $user->save();
        }

        Auth::login($user);

    }

    


}
