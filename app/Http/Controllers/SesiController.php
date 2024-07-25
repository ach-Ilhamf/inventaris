<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    function index()
    {
        return view('kantor.login2');
    }

    // function signup()
    // {
    //   return view('signup');
    // }

    function login2(Request $request)
    {
        $request->validate(
            [
                'username'=>'required',
                'password'=>'required'
            ],[
                'username.required'=>'Username Wajib Diisi',
                'password.required'=>'Password Wajib Diisi',
            ]
            );
      $ceklogin=[
        'username'=>$request->username,
        'password'=>$request->password,
      ] ;     
      if(Auth::attempt($ceklogin)){
        return redirect('/penyedias');
      }else{
        return redirect('')->withErrors('Username dan Password Tidak Sesuai')->withInput();
      }
    }
    function logout(){
        Auth::logout();
        return redirect('/');
    }
public function signup(){
  return view('kantor.signup');
}
public function signup_proses(Request $request){
  $request-> validate([
    'name' => 'required',
    'username' => 'required|unique:users,username',
    'email' => 'required|unique:users,email',
    'password'=>'required|min:5',
    'level'=>'required'
  ]);

  $data['name']=$request->name;
  $data['username']=$request->username;
  $data['email']=$request->email;
  $data['password']=Hash::make($request->password);
  $data['level']=$request->level;
  user::create($data);
  return redirect()->route('login2')->with('success', 'Registration successful! Please login.');
}


}
