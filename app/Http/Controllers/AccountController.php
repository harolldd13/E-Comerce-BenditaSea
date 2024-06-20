<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware( 'user.two.factor');

    }
    

    public function geProfileEdit(){
        $user = User::find(Auth::id());
        $data = ['user' => $user];
        return view('account.profile_edit', $data);
    }
}
