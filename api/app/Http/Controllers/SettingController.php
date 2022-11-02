<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $setting = Setting::where('user_id', $id)->first();
        return view('main.setting', [
            'title' => 'Setting',
            'active' => 'setting',
            'settings' => $setting,
        ]);
    }

    public function setting()
    {
        $user = auth()->user()->id;
        $admin = request()->input('admin');
        $daya = request()->input('daya');
        $limit = request()->input('limit');
        $tmax = request()->input('tmax');
        $asap = request()->input('asap');

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
