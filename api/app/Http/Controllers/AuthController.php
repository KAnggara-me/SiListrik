<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }

  public function logout()
  {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
  }


  /**
   * Handle an authentication attempt.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required',
      'password' => 'required|min:6',
    ]);
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      // if (Auth::user()->status == 0) {
      //   return redirect()->intended('home');
      // } else {
      //   return redirect()->intended('deviceadd');
      // }
      return redirect()->intended('deviceadd');
    }
    return redirect('/login')->with('error', 'Wrong username or password.');
  }

  public function register(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'password' => 'required|min:6',
    ]);

    $username = $request->username;
    $password = $request->password;
    if (isset($username) && isset($password)) {
      $cekuser = User::where('username', '=', $request->username)->first();
      if (!isset($cekuser)) {
        User::create([
          'token' => tokenGen(10),
          'status' => 0,
          'username' => $username,
          'password' => bcrypt($password),
        ]);
        return redirect('/login')->with('success', 'Pendaftaran Berhasil.');
      } else {
        return redirect('/register')->with('error', 'Username sudah terdaftar');
      }
    } else {
      return response()->json(
        [
          'messege' => 'Unauthorized',
        ],
        401,
        [],
        JSON_NUMERIC_CHECK,
      );
    }
  }

  public function registerView()
  {
    return view('auth.register');
  }
}
