<?php

namespace App\Http\Controllers\api;

use App\Models\Bot;
use App\Models\User;
use App\Models\Webhook;
use App\Http\Controllers\Controller;
use App\Models\DeviceLog;

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
			$status_msg = request()->input('message');

			$cekid = Webhook::where('id', $id)->first();

			if ($cekid) {
				return response()->json([
					"success" => false
				], 400, [], JSON_NUMERIC_CHECK);
			}

			$res = Webhook::create([
				'id' => $id,
				'type' => $type,
				'status' => $status,
				'webhook_msg' => $status_msg,
				'message' => $payload['message'],
				'phone_number' => $payload['phone_number'],
				'device_id' => $payload['device_id'],
				'message_type' => $payload['message_type'],
				'caption' => $payload['caption'],
			]);

			return response()->json([
				"success" => $res->isClean()
			], 201, [], JSON_NUMERIC_CHECK);
		} elseif ($type == "incoming_message") {

			$payload = request()->input('payload');
			$msg = $payload['text'];
			$sender = $payload['sender'];
			$device_id = $payload['device_id'];

			$bot = Bot::where('trigger', $msg)->first(); // not null
			$apitoken = User::select('apitoken')->where('username', $device_id)->first(); // not null

			// $id = request()->input('id');

			// $status = request()->input('status');
			// $payload = request()->input('payload');
			// $status_msg = request()->input('message');


			// $cekid = Webhook::where('id', $id)->first();

			// if ($cekid) {
			// 	return response()->json(["success" => false], 400, [], JSON_NUMERIC_CHECK);
			// }

			// $res = Webhook::create([
			// 	'id' => $id,
			// 	'type' => $type,
			// 	'status' => $status,
			// 	'webhook_msg' => $status_msg,
			// 	'message' => $payload['message'],
			// 	'phone' => $payload['phone_number'],
			// 	'device_id' => $payload['device_id'],
			// 	'message_type' => $payload['message_type'],
			// 	'caption' => $payload['caption'],
			// ]);

			if (isset($bot) && isset($apitoken)) {
				// try {
				// 	$reqParams = [
				// 		'token' => $apitoken['apitoken'],
				// 		'url' => 'https://api.kirimwa.id/v1/messages',
				// 		'method' => 'POST',
				// 		'payload' => json_encode([
				// 			'message' => $bot['response'],
				// 			'phone_number' => $sender,
				// 			'message_type' => 'text',
				// 			'device_id' => $device_id,
				// 		])
				// 	];
				// 	$response = apiKirimWaRequest($reqParams);
				// 	return $response['body'];
				// } catch (Exception $e) {
				// 	print_r($e);
				// }
				return response()->json([
					"type" => $type,
					'bot' => $bot,
					'apitoken' => $apitoken,
				], 200, [], JSON_NUMERIC_CHECK);
			}
		}

		return response()->json([
			"type" => "Unknown",
		], 400, [], JSON_NUMERIC_CHECK);
	}

	public function delete()
	{
		$id = request()->input('id');
		$data = Webhook::where('id', $id)->delete();
		return response()->json([
			"success" => $data,
		], 202, [], JSON_NUMERIC_CHECK);
	}
}
