<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Apartament;
use App\Message;
use App\User;

class MessageController extends Controller
{
  public function index() {

    $apartaments = Apartament::where('user_id', Auth::id())->get();
    $apt_ut = [];

    foreach ($apartaments as $apt) {
      array_push($apt_ut, $apt['id']);
    }

    $messages = Message::whereIn('apartament_id', $apt_ut)->get();

    return view("admin.message_index", compact("apartaments", "messages"));
  }




}
