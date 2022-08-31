<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function status(Request $request)
  {
    $a = 'KitKat';
    $token = $request->header('Authorization');
    $token = str_replace('Bearer ', '', $token);
    $url = $request->fullUrl();
    $url = str_replace($request->url() . '?token=', '', $url);
    $version = env('APP_VERSION');
    $stability = env('APP_STABILITY');

    if ($token == $a || ($url == $a)) {
      return response()->json([
        "message" => "WAPI - Unofficial WhatsApp API Gateway",
        "version" => $version,
        "stability" => $stability,
      ], 200, [], JSON_NUMERIC_CHECK);
    } else {
      return response()->json([
        'message' => 'Missing API token.',
      ], 401);
    }
  }
}
