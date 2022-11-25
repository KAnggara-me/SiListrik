<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Relay;
use App\Models\Setting;
use App\Models\SensorLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class APIController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = SensorLog::orderBy('id', 'desc')->first();
    return response()->json($data);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data = SensorLog::where('id', $id)->first();
    if (isset($data)) {
      return response()->json($data);
    }
    return abort(404);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $token = $request->input('token');
    $username = $request->input('username');

    $voltase = (float)$request->input('voltase');
    $arus = (float)$request->input('arus');
    $temperatur = (float)$request->input('temperatur');
    $kelembaban = (float)$request->input('kelembaban');
    $asap = (float)$request->input('asap');
    $api = (float)$request->input('api');

    $valid = User::where('username', $username)->where('token', $token)->first();
    $status = Relay::first();
    $setting = Setting::where('user_id', $valid->id)->first();

    $data = new SensorLog();
    if (isset($valid)) {
      $data->api = $api;
      $data->arus = $arus;
      $data->asap = $asap;
      $data->voltase = $voltase;
      $data->temperatur = $temperatur;
      $data->kelembaban = $kelembaban;
      $data->save();
    }

    $isFlame   = $api > 0;
    $isHighSmoke = $asap > $setting->asap;
    $isHighTemp  = $temperatur > $setting->tmax;
    $isHighVolt = ($arus * $voltase) > $setting->limit;

    if ($isFlame && $isHighSmoke && $isHighTemp) {
      $msg = "*Peringatan!* \n\nKebakaran terdeteksi di rumah anda. \n\n_Silahkan segera periksa!_";
      $response = notifWa($valid->apitoken, $setting->admin, $valid->username, $msg);
      return response()->json([
        'api' => $api,
        'smoke' => $asap,
        'temp' => $temperatur,
        'notif_status' => $response['status'],
        'messege' => $msg,
      ]);
    }

    if ($isHighVolt) {
      $msg = "*Daya melebihi batas maksimal* \n\n" . $arus * $voltase . " VA";
      $response = notifWa($valid->apitoken, $setting->admin, $valid->username, $msg);
      return response()->json([
        'power' => $arus * $voltase,
        'notif_status' => $response['status'],
        'messege' => 'Daya melebihi batas maksimal ' . $arus * $voltase . ' VA'
      ]);
    }

    if ($isHighTemp) {
      $msg = "Temperatur Tinggi *" . $temperatur . "C*";
      $response = notifWa($valid->apitoken, $setting->admin, $valid->username, $msg);
      return response()->json([
        'temp' => $temperatur,
        'messege' => $msg,
      ]);
    }

    if ($isFlame) {
      $msg = "*Api terdeteksi* \nIntensitas: " . $api;
      $response = notifWa($valid->apitoken, $setting->admin, $valid->username, $msg);
      return response()->json([
        'api' => $api,
        'messege' => $msg,
      ]);
    }

    if ($isHighSmoke) {
      $msg = "*Asap terdeteksi* \nIntensitas: " . $asap . " ppm";
      $response = notifWa($valid->apitoken, $setting->admin, $valid->username, $msg);
      return response()->json([
        'smoke' => $asap,
        'messege' => $msg,
      ]);
    }

    return response()->json([
      'voltase' => $data->voltase,
      'arus' => $data->arus,
      'temperatur' => $data->temperatur,
      'kelembaban' => $data->kelembaban,
      'asap' => $data->asap,
      'api' => $data->api,
      "status" => $status->status,
    ], 201, [], JSON_NUMERIC_CHECK);
  }

  public function userStatus($username, $token)
  {
    $user = User::where('username', $username)->where('token', $token)->first();

    if (!$user) {
      return response()->json(['message' => 'Invalid token'], 401, [], JSON_NUMERIC_CHECK);
    }

    return response()->json(
      [
        "status" => $user->status,
      ],
      200,
      [],
      JSON_NUMERIC_CHECK
    );
  }

  public function settingStatus($user)
  {
    $relay = Relay::first();
    $id = User::where('username', $user)->first();
    if (!$id) {
      return response()->json(
        [
          "daya" => 900,
          "tmax" => 35,
          "asap" => 300,
          "limit" => 900,
          "relay" => $relay->status,
        ],
        200,
        [],
        JSON_NUMERIC_CHECK
      );
    }
    $setting = Setting::where('user_id', $id->id)->first();
    return response()->json(
      [
        "daya" => $setting->daya,
        "tmax" => $setting->tmax,
        "asap" => $setting->asap,
        "relay" => $relay->status,
        "limit" => $setting->limit,
      ],
      200,
      [],
      JSON_NUMERIC_CHECK
    );
  }

  public function test()
  {
    $api = env('PS_API');
    $url =  "https://silistrik.apiwa.tech/status";
    $req = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&key={$api}";

    $res = file_get_contents($req);
    $data = json_decode($res, true);
    $base64_image = $data['lighthouseResult']['audits']['full-page-screenshot']['details']['screenshot']['data'];
    $base64_image = explode(",", $base64_image);
    $image = str_replace('data:image/jpeg;base64,', '', $base64_image);

    $img = base64_decode($image[1]);
    $time = time();
    $path = "images/" .  $time . '.' . 'jpg';
    $cek = Storage::put($path, $img);

    if ($cek) {
      header('Content-Type: image/jpeg');
      return response()->file($path);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'error'
    ]);
  }
}
