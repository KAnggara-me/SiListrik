<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;


class IsConnect
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    $username = auth()->user()->username;
    $token = auth()->user()->apitoken;

    // Check Status
    try {
      $reqParams = [
        'token' => $token,
        'url' => 'https://api.kirimwa.id/v1/devices/' . $username,
      ];
      $response = apiKirimWaRequest($reqParams);
      // Add new device
      if ($response['statusCode'] != 200) {
        try {
          $cekidParams = [
            'token' => $token,
            'url' => 'https://api.kirimwa.id/v1/devices',
            'method' => 'POST',
            'payload' => json_encode(['device_id' => $username])
          ];
          $cekid = apiKirimWaRequest($cekidParams);
          if ($cekid['statusCode'] !== 201) {
            return abort(404);
          }
        } catch (Exception $e) {
          print_r($e);
        }
      }
    } catch (Exception $e) {
      print_r($e);
    }

    $response = json_decode($response['body'], true);
    if ($response['status'] === "disconnected") {
      try {
        $reqParams = [
          'token' => $token,
          'url' => 'https://api.kirimwa.id/v1/qr?device_id=' . $username,
        ];
        $response = apiKirimWaRequest($reqParams);
      } catch (Exception $e) {
        print_r($e);
      }
      $response = json_decode($response['body'], true);
      return redirect()->route('connect')->with(['qr' => $response['qr_code']]);
    } else {
      return $next($request);
    }
  }
}
