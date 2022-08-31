<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

  public function login(Request $request)
  {
    $request->validate([
      'username' => 'required',
      'password' => 'required|min:6',
    ]);

    $username = "namanama";
    $pass = "aku";
    $email = $request->input('username');
    $password = $request->input('password');

    if ($email == $username && $password == $pass) {
      echo $email . " " . $password . " Login berhasil";
    } else {
      echo $email . " " . $password . " Login Gagal";
    }
  }

  public function register(Request $request)
  {
    function tokenGen($length = 10)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

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
      return response()->json([
        "messege" => "Unauthorized",
      ], 401, [], JSON_NUMERIC_CHECK);
    }
  }
}
