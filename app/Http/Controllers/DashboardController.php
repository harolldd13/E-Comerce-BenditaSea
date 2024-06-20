<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('IsAdmin');
        $this->middleware( 'user.two.factor');

    }
    

    public function getHome(){
        $data = [];
        return view('dashboard', $data);
    }
}
