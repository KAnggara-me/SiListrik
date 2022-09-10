<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    return view('main.home', ['title' => 'Home', 'active' => 'home']);
  }

  public function setting(Request $request)
  {
    echo view('main.setting', [
      'title' => 'Setting',
      'active' => 'setting'
    ]);
  }

  public function notif(Request $request)
  {
    echo view('main.notif', [
      'title' => 'Notification',
      'active' => 'notif'
    ]);
  }

  public function logs(Request $request)
  {
    echo view('main.logs', [
      'title' => 'Logs',
      'active' => 'logs'
    ]);
  }

  public function deviceadd(Request $request)
  {
    echo view('main.deviceadd', [
      'title' => 'Add Device',
      'active' => 'home'
    ]);
  }

  public function connect()
  {
    $show = true;
    $qr = session()->get('qr');
    if (!isset($qr)) {
      $show = false;
      return redirect('home');
    }
    return view('main.reconnect', ['title' => 'Disconnected', 'active' => 'home', 'qr' => $qr, 'show' => $show]);
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