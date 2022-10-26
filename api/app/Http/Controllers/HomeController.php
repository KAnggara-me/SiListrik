<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\SensorLog;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
  public function index()
  {
    $sensor = SensorLog::orderBy('id', 'desc')->limit(25)->get();
    $last = $sensor->first();
    foreach ($sensor as $s) {
      $daya[] = \number_format($s->voltase * $s->arus, '0', '.', '');
      $suhu[] = $s->temperatur;
      $date[] = $s->created_at->format('H:i') . ' WIB';
    }

    return view('main.home', [
      'title' => 'Home',
      'active' => 'home',
      'suhu' => $suhu,
      'last' => $last,
      'daya' => $daya,
      'date' => $date,
    ]);
  }

  public function notif()
  {
    $sensor = SensorLog::orderBy('id', 'desc')->limit(250)->get();
    return view('main.notif', [
      'title' => 'Notification',
      'active' => 'notif',
      'sensors' => $sensor,
    ]);
  }


  public function logs()
  {
    $sensor = SensorLog::orderBy('id', 'desc')->limit(250)->get();
    return view('main.logs', [
      'title' => 'Logs',
      'active' => 'logs',
      'sensors' => $sensor,
    ]);
  }

  public function setting()
  {
    $sensor = SensorLog::orderBy('id', 'desc')->limit(250)->get();
    return view('main.setting', [
      'title' => 'Setting',
      'active' => 'setting',
      'sensors' => $sensor,
    ]);
  }

  public function connect()
  {
    $username = auth()->user()->username;
    $data = User::where('username', $username)->first();

    if ($data->status !== 1) {
      try {
        $reqParams = [
          'token' => $data->apitoken,
          'url' => 'https://api.kirimwa.id/v1/qr?device_id=' . $data->username,
        ];
        $response = apiKirimWaRequest($reqParams);
        $res = json_decode($response['body'], true);
      } catch (Exception $e) {
        print_r($e);
      }
      return view('main.reconnect', ['title' => 'Scan QR', 'active' => '', 'qr' => $res['qr_code']]);
    }

    return redirect()->route('home');
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
        $data = json_decode($response['body'], true);
        $qrcode = QrCode::size(300)->generate($data['qr_code']);
        return $qrcode;
      } catch (Exception $e) {
        print_r($e);
      }
    }
  }
}
