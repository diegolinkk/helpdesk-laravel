<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginForm()
    {
        return view('login.login-form');
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            return redirect()->back()->withErrors("E-mail ou senha incorretos");
        }

        return redirect()->route('ticket_list');
        
    }
}
