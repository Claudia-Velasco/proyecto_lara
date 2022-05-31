<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite as Socialite;
use AuthenticatesUsers;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth/login');
    }
    /**
     * Redirecciona al usuario a la página de Facebook para autenticarse
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Obtiene la información de Facebook
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->user(); // Fetch authenticated user
       // dd($auth_user);
       return redirect('casilla'); //Retornamos a la página principal 
    }


    public function logout(Request $request, Redirector $redirector)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return $redirector->to('/login');
    }
}
