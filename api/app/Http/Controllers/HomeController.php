<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Relay;
use App\Models\Setting;
use App\Models\Webhook;
use App\Models\SensorLog;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
  public function index()
  {
    $sensor = SensorLog::orderBy('id', 'desc')->limit(25)->get();
    $setting = Setting::first();
    $relay = Relay::first();
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
      'setting' => $setting,
      'relay' => $relay,
    ]);
  }

  public function logs()
  {
    $webhook = Webhook::orderBy('updated_at', 'desc')->limit(100)->get();
    return view('main.logs', [
      'title' => 'Logs',
      'active' => 'logs',
      'logs' => $webhook,
    ]);
  }

  public function notif()
  {
    $id = auth()->user()->id;
    $sensor = SensorLog::orderBy('id', 'desc')->limit(250)->get();
    $setting = Setting::where('user_id', $id)->first();
    return view('main.notif', [
      'title' => 'Notification',
      'active' => 'notif',
      'sensors' => $sensor,
      'settings' => $setting,
    ]);
  }

  public function bot()
  {
    $id = auth()->user()->id;
    $sensor = SensorLog::orderBy('id', 'desc')->limit(250)->get();
    $setting = Setting::where('user_id', $id)->first();
    return view('main.notif', [
      'title' => 'Bot Setting',
      'active' => 'bot',
      'sensors' => $sensor,
      'settings' => $setting,
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

  public function status()
  {
    $sensor = SensorLog::orderBy('id', 'desc')->limit(25)->get();
    $setting = Setting::first();
    $relay = Relay::first();
    $last = $sensor->first();
    foreach ($sensor as $s) {
      $daya[] = \number_format($s->voltase * $s->arus, '0', '.', '');
      $suhu[] = $s->temperatur;
      $date[] = $s->created_at->format('H:i') . ' WIB';
    }
    $now = date('D, d M Y | H:i:s');
    return view('status', [
      'suhu' => $suhu,
      'last' => $last,
      'daya' => $daya,
      'date' => $date,
      'now' => $now,
      'setting' => $setting,
      'relay' => $relay,
    ]);
  }
}
