<?php

namespace MyCore\Core\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller 
{
    public function login()
    {
        return view('mc_core::auth.login');
    }

    public function postLogin(Request $request)
    {
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:4'
        );
        $validator = Validator::make($request->all() , $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors($validator);
        } else {
            $attempt = array(
                'email' => $request->email,
                'password' => $request->password
            );
            // attempt to do the login
            if (Auth::attempt($attempt)) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('admin.login')->withErrors('Email hoặc mật khẩu không đúng!');
            }
        }
    }

    public function logout()
    {   
        Auth::logout();
        return redirect()->route('admin.login');
    }
}

