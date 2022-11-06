<?php

namespace App\Http\Controllers\api;

use App\Models\Bot;
use App\Models\User;
use App\Models\Webhook;
use App\Models\DeviceLog;
use App\Models\SensorLog;
use App\Http\Controllers\Controller;

class WebhookController extends Controller
{
	public function index()
	{
		$type = request()->input('webhook_type');

		if ($type == "device_status_changed") {
			$status = request()->input('status');
			$device_id = request()->input('device_id');

			if ($status == "connected") {
				User::where('username', $device_id)->update(['status' => 1]);
			} else {
				User::where('username', $device_id)->update(['status' => 0]);
			}

			DeviceLog::create([
				'device_id' => $device_id,
				'status' => $status,
			]);

			return response()->json([
				"type" => $type,
				'status' => $status,
			], 200, [], JSON_NUMERIC_CHECK);
		} elseif ($type == "send_message_response") {

			$id = request()->input('id');
			$status = request()->input('status');
			$payload = request()->input('payload');
			$status_msg = $status == "success" ? "Message sent" : $status;
			$res = Webhook::where('id', $id)->update([
				'status' => $status,
				'webhook_msg' => $status_msg,
				'message' => $payload['message'],
				'caption' => $payload['caption'],
				'device_id' => $payload['device_id'],
				'message_type' => $payload['message_type'],
				'phone_number' => $payload['phone_number'],
			]);

			return response()->json([
				"success" => $res,
			], 200, [], JSON_NUMERIC_CHECK);
		} elseif ($type == "incoming_message") {
			$payload = request()->input('payload');

			$username = $payload['device_id'];
			$isGroup = $payload['is_group_message'];
			$isStatus = strtolower($payload['text']) == "status";
			$reciver = $isGroup ? $payload["group_id"] : $payload['sender'];

			$isTriggred = Bot::where('trigger', strtolower($payload['text']))->where('device_id', $username)->first();

			if ($isTriggred || $isStatus) {
				$webhook = new Webhook();
				if (env('APP_ENV') == 'local') {
					$webhook->id = tokenGen();
				} else {
					$webhook->id = $payload['id'];
				}
				$webhook->type = $type;
				$webhook->status = "success";
				$webhook->webhook_msg = $type;
				$webhook->message = $payload['text'];
				$webhook->caption = $payload['caption'];
				$webhook->device_id = $username;
				$webhook->phone_number = $payload['sender'];
				$webhook->message_type = $payload['message_type'];
				$webhook->save();
			}

			if ($isStatus) {
				$data = SensorLog::orderBy('updated_at', 'desc')->first();
				$date = $data->updated_at->format('d/M/y H:i:s');
				$daya = ($data->arus * $data->voltase) == 0 ? "_error_" : number_format(($data->arus * $data->voltase), '0', ',', '.');
				$caption = "\n_Status Sensor_\n\n*Daya Digunakan:* " . $daya . " VA" . "\n*Temperatur:* " . number_format(($data->temperatur), '0', ',', '.') . "C°" . "\n*Asap:* " . number_format(($data->asap), '0', ',', '.') . "ppm" . "\n\n```Update Terakhir:``` " . $date . "\n";
				$token = User::where('username', $username)->first()->apitoken;
				// $time = time();
				// $image = getImage($time);
				// $isExist = file_exists(public_path('images/' . $time . '.jpg'));
				$msg = "https://silistrik.apiwa.tech/images/img.jpg";
				// $msg = ($isExist && $image) ? "https://silistrik.apiwa.tech/images/" . $time . ".jpg" : "https://silistrik.apiwa.tech/images/img.jpg";
				$response = notifWa(
					$token,
					$reciver,
					$username,
					$msg,
					$isGroup,
					"image",
					$caption,
				);
				return response()->json(
					$response,
					201,
					[],
					JSON_NUMERIC_CHECK
				);
			}

			if ($isTriggred) {
				$msg = $isTriggred->response;
				$token = User::where('username', $username)->first()->apitoken;
				$response = notifWa($token, $reciver, $username, $msg, $isGroup);
				return response()->json(
					$response,
					201,
					[],
					JSON_NUMERIC_CHECK
				);
			}

			return response()->json([
				"recived" => true,
			], 200, [], JSON_NUMERIC_CHECK);
		}

		return response()->json([
			"type" => "Unknown",
		], 400, [], JSON_NUMERIC_CHECK);
	}

	public function debug()
	{
		$req = request()->all();
		$data = json_encode($req);
		$webhook = new Webhook();
		$webhook->type = "send_message_response";
		$webhook->id = tokenGen();
		$webhook->status = "success";
		$webhook->webhook_msg = "send_message_response";
		$webhook->message = $data;
		$webhook->device_id = "admina";
		$webhook->phone_number = "628123456789";
		$webhook->message_type = "text";
		$webhook->save();

		return response()->json(
			$webhook,
			201,
			[],
			JSON_NUMERIC_CHECK
		);
	}
}
