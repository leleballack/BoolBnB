<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InfoMessage;
use App\Apartament;
use App\Message;
use App\User;

class MessageController extends Controller
{
  public function index(Request $request) {


    $apartaments = Apartament::where('user_id', Auth::id())->get();
    $apt_ut = [];



    foreach ($apartaments as $apt) {
      array_push($apt_ut, $apt['id']);
    }

    $messages = Message::whereIn('apartament_id', $apt_ut)->get();


    return view("admin.message_index", compact("apartaments", "messages"));
  }

  public function show($id)
  {
    $message = Message::findOrFail($id);

    return view("admin.message_reply", compact("message"));
  }

  public function sendMessage(Request $request)
  {
    $data = $request->all();

    Mail::to($data['email'])->send(new InfoMessage($data['email']));

    $msgToDelete = Message::find($data['id'])->delete();
      return redirect()->route('admin.message.index')->with('message_send', 'Il messagggio è stato inviato correttamente');
  }

  public function destroy($id)
  {
      $msgToDelete = Message::find($id)->delete();
      return redirect()->route('admin.message.index');
  }

}
