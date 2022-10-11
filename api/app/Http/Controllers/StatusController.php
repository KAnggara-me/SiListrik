<?php

namespace App\Http\Controllers;

use App\Models\User;

class StatusController extends Controller
{
  public function status()
  {
    $username = request()->bearerToken();
    $status = User::where('username', $username)->first();

    if (isset($status)) {
      $status = $status->status;
      return response()->json(['status' => $status], 200, [], JSON_NUMERIC_CHECK);
    } else {
      return response()->json(['status' => 0], 200, [], JSON_NUMERIC_CHECK);
    }
  }
}
