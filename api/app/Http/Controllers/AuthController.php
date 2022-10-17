<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function logout()
  {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'username' => 'required',
      'password' => 'required|min:6',
    ]);
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      $user = User::where('username', $request->username)->first();
      if ($user->status != 1) {
        return redirect()->intended('connect');
      }
      return redirect()->intended('home');
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
        ['messege' => 'Unauthorized'],
        401,
        [],
        JSON_NUMERIC_CHECK
      );
    }
  }
}
