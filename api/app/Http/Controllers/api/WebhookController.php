<?php

namespace App\Http\Controllers\api;

use App\Models\Bot;
use App\Models\User;
use App\Models\Webhook;
use App\Http\Controllers\Controller;
use App\Models\DeviceLog;
use App\Models\SensorLog;

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
			$check = Webhook::where('id', $payload['id'])->first();

			if (!isset($check)) {
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
			}

			if ($payload['text'] == "status") {
				$data = SensorLog::orderBy('updated_at', 'desc')->first();
				$date = $data->updated_at->format('d/M/y H:i:s');
				$daya = ($data->arus * $data->voltase) == 0 ? "_error_" : number_format(($data->arus * $data->voltase), '0', ',', '.');
				$msg = "Daya Digunakan: " . $daya . " VA" . "\nTemperatur: " . $data->temperatur . "C°" . "\nAsap: " . $data->asap . "ppm" . "\n\n_Update Terakhir:_ " . $date;
				$token = User::where('username', $payload['device_id'])->first()->apitoken;
				$response = notifWa($token, $payload['sender'], $payload['device_id'], $msg);
				return response()->json(
					$msg,
					201,
					[],
					JSON_NUMERIC_CHECK
				);
			}

			$trigered = Bot::where('trigger', $payload['text'])->where('device_id', $payload['device_id'])->first();
			if ($trigered) {
				$token = User::where('username', $payload['device_id'])->first()->apitoken;
				$response = notifWa($token, $payload['sender'], $payload['device_id'], $trigered->response);
				return response()->json(
					$response,
					201,
					[],
					JSON_NUMERIC_CHECK
				);
			}
			return response()->json(
				"This response is sent when a request conflicts with the current state of the server.",
				409,
				[],
				JSON_NUMERIC_CHECK
			);
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
		$webhook->id = "123456789";
		$webhook->status = "success";
		$webhook->webhook_msg = "send_message_response";;
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
