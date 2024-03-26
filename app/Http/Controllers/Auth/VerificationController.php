<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Models\User;

class VerificationController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify','resend');
    }

    public function notice(Request $request)
    {
        return $request->user()->hasVerifiedEmail() 
            ? redirect()->route('admin') : view('backend.Pages.email_verify');
    }

    public function verify(EmailVerificationRequest $request){
        $request->fulfill();

        // Update the email_verify column to '1' for the authenticated user
        if(auth()->check()) {
            auth()->user()->update(['email_verify' => '1']);

           //dd(auth()->user());
        }

        return redirect()->route('admin');
    }

    public function resend(Request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()
        ->withSuccess('A fresh verification link has been sent to your email.');
    }

}
