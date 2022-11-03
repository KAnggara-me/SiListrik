<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
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
