<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    protected function authenticated(Request $request, $user)
    {


        
// //        Here authenticate user if user type is admin
//         if ($user->type == 'Admin'){
// //            return true;
//         }else {
//             Auth::logout();
//             return redirect('/login')->with('error','These credentials do not match our records.');

//         }
  // Check user roles and redirect accordingly
        if ($user->hasRole('admin')) {
            return redirect()->route('admin');
        } elseif ($user->hasRole('user')) {
            return redirect()->route('user');
        }elseif ($user->hasRole('vendor_user')) {
            return redirect()->route('vendor_user');
        }  else {
            return redirect()->route('login');
        }
    }
    
}
