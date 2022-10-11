<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class IsConnect
{
  public function handle(Request $request, Closure $next)
  {
    $username = auth()->user()->username;
    $status = User::select('status')->where('username',  $username)->first();

    // Check Status
    if ($status['status'] !== 1) {
      return redirect()->route('connect')->with(['username' => $username]);
    } else {
      return $next($request);
    }
  }
}
