<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
        return redirect('/agendas');
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

    public function edit_user()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('kantor.edit_user', compact('user'));
        }
        return redirect()->route('login')->with(['error' => 'You must be logged in to access this page.']);
    }

    public function update_user(Request $request, $id): RedirectResponse
    {
    $user = User::findOrFail($id);

    if (Auth::user()->id !== $user->id) {
        return redirect()->route('agendas.index')->with(['error' => 'Unauthorized action.']);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:5|confirmed', // Password is optional and needs to be confirmed if provided
    ]);

    $data = $request->only(['name', 'username', 'email']);
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('agendas.index')->with(['success' => 'Akun Berhasil Diubah!']);
}



}
