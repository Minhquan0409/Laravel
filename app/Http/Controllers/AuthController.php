<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signin(){
        return view('auth.signin');
    }
    
    public function checkSignin(Request $request) {
        if($request->input('username') == 'minhquan0409' && $request->input('password') == '123456' && $request->input('repass') == '123456' && $request->input('mssv') == '4009567' && $request->input('class') == '67PM1' && $request->input('gender') == 'Male'){
            return "signin successfully";
        } else {
            return "signin failed";
        }
    }

    public function signup(){
        return view('auth.signup');
    }

    public function checkSignup(Request $request) {
        if ($request->filled('username') && $request->filled('password') && $request->filled('repass') && $request->input('password') == $request->input('repass') && $request->filled('mssv') && $request->filled('class') && $request->filled('gender')) {
            return "signup successfully";
        } else {
            return "signup failed";
        }
    }
}