<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
	public function index()
	{
		return response()->json([
			'status' => 'success',
			'message' => 'Webhook API',
		], 200, [], JSON_NUMERIC_CHECK);
	}
}
