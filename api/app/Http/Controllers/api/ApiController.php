<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
  /**
   * API Version
   * @param  \Illuminate\Http\Request  $request
   */
  public function apiVersion()
  {
    // Check token
    $token = request()->input('token');
    if (!isset($token)) {
      $token = request()->bearerToken();
    }
    if (!isset($token)) {
      return response()->json([
        'message' => 'Missing API token.'
      ], 401);
    }
    $user = User::where('token', $token)->first();
    if (!$user) {
      return response()->json(['message' => 'Invalid token'], 403, [], JSON_NUMERIC_CHECK);
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

  public function qrCode()
  {
    $token = request()->input('token');
    if (!isset($token)) {
      $token = request()->bearerToken();
    }
    if (!isset($token)) {
      return response()->json([
        'message' => 'Missing API token.'
      ], 401);
    }
    $user = User::where('token', $token)->first();
    if (!$user) {
      return response()->json(['message' => 'Invalid token'], 403, [], JSON_NUMERIC_CHECK);
    } else {
      try {
        $reqParams = [
          'token' => $user->apitoken,
          'url' => 'https://api.kirimwa.id/v1/qr?device_id=' . $user->username,
        ];
        $response = apiKirimWaRequest($reqParams);
        return response()->json(json_decode($response['body'], true), json_decode($response['statusCode'], true), [], JSON_NUMERIC_CHECK);
      } catch (Exception $e) {
        print_r($e);
      }
    }
  }
}
