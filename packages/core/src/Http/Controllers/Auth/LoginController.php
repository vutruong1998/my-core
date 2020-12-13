<?php

namespace MyCore\Core\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller 
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('mc_core::auth.login');
    }

    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:4'
        );
        $validator = Validator::make($request->all() , $rules);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator);
        } else {
            $attempt = array(
                'email' => $request->email,
                'password' => $request->password
            );
            // attempt to do the login
            if (Auth::attempt($attempt)) {
                return redirect()->route('index');
            } else {
                return redirect()->route('login')->withErrors('Email hoặc mật khẩu không đúng!');
            }
        }
    }

    public function logout()
    {   
        Auth::logout();
        return redirect()->route('login');
    }
}

