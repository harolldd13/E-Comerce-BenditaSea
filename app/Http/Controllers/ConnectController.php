<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;
use App\Models\User;
use App\Mail\SendCodeTwoFactor;
use Illuminate\Support\Facades\Mail;

class ConnectController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except(['getLogout', 'getTwoFactor']);

    }
    public function getLogin(){
        return view('connect.login');
    }
    public function getTwoFactor(){
        $this->getSendCodeTwoFactor();
        return view('connect.two_factor');
     
    }
    public function getLogout(){
        Cookie::queue(Cookie::forget('browser_trusted'));
        Auth::logout();
        return redirect('/');
    }
    public function getSendCodeTwoFactor(){
        $code = rand(100001, 999999);
        $data =['code'=>$code, 'name'=> Auth::user()->name];

        $user = User::find(Auth::id());
        $user->auth_code = $code;
        $user->save();


        Mail::to($user->email)->send(new SendCodeTwoFactor($data));
     
    }
}
