<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Relay;
use App\Models\SensorLog;
use App\Models\Setting;

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
      //TODO: Send to Whatsapp
      return response()->json([
        'api' => $api,
        'smoke' => $asap,
        'temp' => $temperatur,
        'messege' => 'Kebakaran Terdeteksi'
      ]);
    }

    if ($isHighVolt) {
      //TODO: Send to Whatsapp
      return response()->json([
        'power' => $arus * $voltase,
        'messege' => 'Daya melebihi batas maksimal ' . $arus * $voltase . ' VA'
      ]);
    }

    if ($isHighTemp) {
      //TODO: Send to Whatsapp
      return response()->json([
        'temp' => $temperatur,
        'messege' => 'Temperatur Tinggi ' . $temperatur . ' C'
      ]);
    }

    if ($isFlame) {
      //TODO: Send to Whatsapp
      return response()->json([
        'api' => $api,
        'messege' => 'Api terdeteksi'
      ]);
    }

    if ($isHighSmoke) {
      //TODO: Send to Whatsapp
      return response()->json([
        'smoke' => $asap,
        'messege' => 'Asap terdeteksi ' . $asap . ' ppm'
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
}
