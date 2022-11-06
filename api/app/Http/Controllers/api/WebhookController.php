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
			$group = $payload['is_group_message'];
			$reciver = $group ? $payload["group_id"] : $payload['sender'];
			$check = Webhook::where('id', $payload['id'])->first();

			if (isset($check)) {
				return response()->json(
					"This response is sent when a request conflicts",
					409,
					[],
					JSON_NUMERIC_CHECK
				);
			}

			$webhook = new Webhook();
			$webhook->type = $type;
			$webhook->id = $payload['id'];
			$webhook->status = "success";
			$webhook->webhook_msg = $type;
			$webhook->message = $payload['text'];
			$webhook->caption = $payload['caption'];
			$webhook->device_id = $payload['device_id'];
			$webhook->phone_number = $payload['sender'];
			$webhook->message_type = $payload['message_type'];
			$webhook->save();

			if (strtolower($payload['text']) == "status") {
				$data = SensorLog::orderBy('updated_at', 'desc')->first();
				$date = $data->updated_at->format('d/M/y H:i:s');
				$daya = ($data->arus * $data->voltase) == 0 ? "_error_" : number_format(($data->arus * $data->voltase), '0', ',', '.');
				$caption = "\n_Status Sensor_\n\n*Daya Digunakan:* " . $daya . " VA" . "\n*Temperatur:* " . number_format(($data->temperatur), '0', ',', '.') . "C°" . "\n*Asap:* " . number_format(($data->asap), '0', ',', '.') . "ppm" . "\n\n```Update Terakhir:``` " . $date . "\n";
				$token = User::where('username', $payload['device_id'])->first()->apitoken;
				$msg = "https://github.com/kanggara.png";
				$response = notifWa($token, $reciver, $payload['device_id'], $msg, $group, "image", $caption);
				return response()->json(
					$msg,
					201,
					[],
					JSON_NUMERIC_CHECK
				);
			}

			$trigered = Bot::where('trigger', strtolower($payload['text']))->where('device_id', $payload['device_id'])->first();
			if ($trigered) {
				$token = User::where('username', $payload['device_id'])->first()->apitoken;
				$response = notifWa($token, $reciver, $payload['device_id'], $trigered->response, $group);
				return response()->json(
					$response,
					201,
					[],
					JSON_NUMERIC_CHECK
				);
			}
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
		$webhook->webhook_msg = "send_message_response";;
		$webhook->message = $req;
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
