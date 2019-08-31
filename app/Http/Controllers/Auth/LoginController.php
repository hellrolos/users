<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest', ['only' => 'showLoginForm']);
    }
    public function showLoginForm(){
        return view('login');
    }
    public function login(){
        $credenciales = $this->validate(request(), [
            $this->username() => 'email|required|string',
            'password' => 'required|string'
        ]);
        /*$Username = request(['email']);
        $dbUsername = User::where("email","=", $Username)->first();
        dd($dbUsername);*/
        if (Auth::attempt($credenciales)){
            return redirect()->route('dashboard');
        }
        return back()->withErrors([$this->username() => 'Estas credenciales no coinciden'])->withInput(request([$this->username()]));
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function username(){
        return 'email';
    }
}
