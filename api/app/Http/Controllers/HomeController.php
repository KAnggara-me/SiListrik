<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(Request $request)
  {
    echo view('main.home', [
      'title' => 'Home',
      'active' => 'home'
    ]);
  }

  public function setting(Request $request)
  {
    echo view('main.setting', [
      'title' => 'Setting',
      'active' => 'setting'
    ]);
  }

  public function notif(Request $request)
  {
    echo view('main.notif', [
      'title' => 'Notification',
      'active' => 'notif'
    ]);
  }

  public function logs(Request $request)
  {
    echo view('main.logs', [
      'title' => 'Logs',
      'active' => 'logs'
    ]);
  }
}
