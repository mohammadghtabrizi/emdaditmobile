<?php

namespace App\Http\Controllers\mobileweb\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class LogoutController extends Controller
{
    public function Logout(){

    	auth()->logout();

    	session()->flash('messageq', 'Some goodbye message');

    	return redirect('/');
  }
}
