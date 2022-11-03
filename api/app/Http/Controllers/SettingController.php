<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit()
	{
		$id = auth()->user()->id;
		$setting = Setting::where('user_id', $id)->first();
		return view('main.setting', [
			'title' => 'Setting',
			'active' => 'setting',
			'settings' => $setting,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$user = auth()->user()->id;
		$admin = $request->input('admin');
		$daya = $request->input('daya');
		$limit = $request->input('limit');
		$tmax = $request->input('tmax');
		$asap = $request->input('asap');

		$data = [
			'admin' => $admin,
			'daya' => $daya,
			'limit' => $limit,
			'tmax' => $tmax,
			'asap' => $asap,
		];

		Setting::where('user_id', $user)->update($data);
		return redirect('/setting')->with('success', 'Data Disimpan');
	}
}
