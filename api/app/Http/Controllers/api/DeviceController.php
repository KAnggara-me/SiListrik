<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;

class DeviceController extends Controller
{
	/**
	 * Device List
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $id
	 * @return \Illuminate\Http\Response
	 */
	public function devicelist()
	{
		$token = request()->input('token');
		if (!isset($token)) {
			$token = request()->bearerToken();
		}
		$user = User::where('token', $token)->first();
		if (!$user) {
			return response()->json(['message' => 'Invalid token'], 403, [], JSON_NUMERIC_CHECK);
		} else {
			// Lihat apiKirimWaRequest() pada Contoh Integrasi diatas
			try {
				$reqParams = [
					'token' => $user->apitoken,
					'url' => 'https://api.kirimwa.id/v1/devices'
				];
				$response = apiKirimWaRequest($reqParams);
				return response()->json(json_decode($response['body']), json_decode($response['statusCode']), [], JSON_NUMERIC_CHECK);
			} catch (Exception $e) {
				print_r($e);
			}
		}
	}

	/**
	 * Add devices id
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deviceAdd()
	{
		$token = request()->bearerToken();
		$id = request()->input('device_id');
		$user = User::where('token', $token)->first();
		if (!$user) {
			return response()->json(['message' => 'Invalid token'], 403, [], JSON_NUMERIC_CHECK);
		} else {
			try {
				$reqParams = [
					'token' => $user->apitoken,
					'url' => 'https://api.kirimwa.id/v1/devices',
					'method' => 'POST',
					'payload' => json_encode([
						'device_id' => $id,
					])
				];

				$response = apiKirimWaRequest($reqParams);
				return response()->json(json_decode($response['body'], true), json_decode($response['statusCode'], true), [], JSON_NUMERIC_CHECK);
			} catch (Exception $e) {
				print_r($e);
			}
		}
	}

	/**
	 * Update the specified user.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  string  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deviceId($id)
	{
		// Check token
		$token = request()->input('token');
		if (!isset($token)) {
			$token = request()->bearerToken();
		}
		$user = User::where('token', $token)->first();
		if (!$user) {
			return response()->json(['message' => 'Invalid token'], 403, [], JSON_NUMERIC_CHECK);
		} else {
			try {
				$reqParams = [
					'token' => $user->apitoken,
					'url' => 'https://api.kirimwa.id/v1/devices/' . $id,
				];
				$response = apiKirimWaRequest($reqParams);
				return response()->json(json_decode($response['body'], true), json_decode($response['statusCode'], true), [], JSON_NUMERIC_CHECK);
			} catch (Exception $e) {
				print_r($e);
			}
		}
	}

	/**
	 * Update the specified user.
	 *
	 * @param  string  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deleteDevice($id)
	{
		$token = request()->bearerToken();
		$user = User::where('token', $token)->first();
		if (!$user) {
			return response()->json(['message' => 'Invalid token'], 403, [], JSON_NUMERIC_CHECK);
		} else {
			try {
				$reqParams = [
					'method' => 'DELETE',
					'token' => $user->apitoken,
					'url' => 'https://api.kirimwa.id/v1/devices/' . $id,
				];
				$response = apiKirimWaRequest($reqParams);
				return response()->json(json_decode($response['body'], true), json_decode($response['statusCode'], true), [], JSON_NUMERIC_CHECK);
			} catch (Exception $e) {
				print_r($e);
			}
		}
	}
}
