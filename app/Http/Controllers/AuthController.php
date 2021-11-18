<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function daftar(Request $request){
        $request->validate([
            'email'   => 'unique:users|min:5',
            'name'   => '|min:2',
            'password'   => '|min:6',
        ]);
     $data = new User();
     $data->name = $request->input('name');
     $data->email = $request->input('email');
     $data->password = Hash::make($request->input('password'));
    $data->save();

    return redirect('/login')->with("sukses", "Berhasil register, Silahkan Login");
      
    }


    public function postlogin(Request $request)
    {
        $cre = $request->only('email','password');
        if (Auth::attempt($cre)) {
            return redirect('/dashboard');
        }
        return redirect()->back()->with('sukses','Email atau Password Salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register(){
        return view('auths.register');
    }
    


}
