<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Traits\GurdedNameTriat;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use GurdedNameTriat;
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

   //use AuthenticatesUsers;

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
     public function loginForm($type){

        return view('auth.login',compact('type'));

     }
     public function login(Request $request){
       // dd($request);
     //  dd($request);

     $guarded= $this->getGurdedName($request);
       //dd(Auth::guard($this->getGurdedName($request))->attempt(['email' => $request->email,'password' => $request->password]));
       if(Auth::guard($this->getGurdedName($request))->attempt(['email'=> $request->email,'password'=> $request->password])){
    return  $this->redirect_To($request);
       }else{

     //   dd('wrooong');
         return redirect()->back();
       }
     }
     public function logout(Request $request,$type){
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return      redirect('/');
     }
}
