<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;

class ApiController extends Controller
{
  public function apiStatus()
  {
    // Check token
    $token = request()->input('token');
    if (!isset($token)) {
      $token = request()->bearerToken();
    }
    $user = User::where('token', $token)->first();
    if (!$user) {
      return response()->json(['message' => 'Invalid token'], 401, [], JSON_NUMERIC_CHECK);
    } else {
      try {
        $reqParams = [
          'token' => $user->apitoken,
          'url' => 'https://api.kirimwa.id/v1'
        ];
        $response = apiKirimWaRequest($reqParams);
        return response()->json(json_decode($response['body'], true), json_decode($response['statusCode'], true), [], JSON_NUMERIC_CHECK);
      } catch (Exception $e) {
        print_r($e);
      }
    }
  }
}
