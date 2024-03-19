<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
//use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cookie;

use Carbon\Carbon;

use App\Models\User;

class UserController extends Controller
{
    //
    public function index(){
        return view('backend.Pages.dashbord');
    }


    // login form get
    public function login(){
        return view('backend.Pages.login');
    }

    //login check

    public function loginSave(Request $request){
        //dd($request->all());

        $valDat =$request->validate([
            'email' =>'required | email',
            'password'=>'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->filled('remember'))){
            $request->session()->regenerate();

            if ($request->filled('remember')) {
                $cookieTime = 3600;
                $cookieEmail = $request->email;
                $cookiePassword = $request->password;

                Cookie::queue('adminuser', $cookieEmail, $cookieTime);
                Cookie::queue('adminpwd', $cookiePassword, $cookieTime);
            } else {
                Cookie::queue(Cookie::forget('adminuser'));
                Cookie::queue(Cookie::forget('adminpwd'));
            }

            return redirect()->intended('admin');
        }
        return back()->withErrors([
            'email' =>'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function register(){
        return view('backend.Pages.register');
    }

    public function registerSave(Request $request){

       // dd($request);
        $valiData=$request->validate([
            'fullname'=>'required | max:255',
            'email'=>'required | email|unique:users,email',
            'password' => ['required','string','min:8','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
            'cpassword'=>'required | same:password'
        ]);

        $data =[
            'name'=>$request->fullname,
            'email'=>$request->email,
            'password'=>$request->password,
            'phone' => '',
        ];

        $user =User::create( $data);

        if($user){
            $user->sendEmailVerificationNotification();
            //$user->sendEmailVerificationNotification();
            //return $user;
            //return redirect()->route('emailvarify');
            //return redirect()->route('verification.notice');

             Auth::login($user);
            // return redirect()->route('verification.notice');
             return redirect()->intended('admin');
        }else
        {
        return back()->withErrors([
            'errormsg' =>'Some thing wentwrong.!!!']);
        }
    }



    public function redirectGoogle(){

        return Socialite::driver('google')->redirect();

    }

    public function responseGoogle(){

        $user = Socialite::driver('google')->user();
        //dd($user->getAvatar());

        if($user){
            $existingUser = User::where('email', $user->getEmail())->first();

            //dd($existingUser);

            if(!$existingUser){
                $authenticatedUser = User::firstOrCreate([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => bcrypt('password'),
                    'profile_image'=>$user->getAvatar(),
                    'email_verify'=> '1',
                    'email_verified_at'=>Carbon::now()->toDateTimeString()
                ]);
            }
            else{
                $authenticatedUser = $existingUser;
            }

            if($authenticatedUser){
                $authenticatedUser->update(['email_verify' => '1']);
                Auth::login($authenticatedUser);
                return redirect()->intended('admin');
            }else
            {
            return back()->withErrors([
                'errormsg' =>'Some thing wentwrong.!!!']);
            } 
        }else
        {
        return back()->withErrors([
            'errormsg' =>'Some thing wentwrong.!!!']);
        }
        
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/admin/login');
    }


    public function emialVerify(){
        return  view('backend.Pages.email_verify');
        //return 'test';
    }
}
