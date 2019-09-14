<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InfoMessage;
use App\Apartament;
use App\Message;

class MessageController extends Controller
{

    public function store(Request $request){
      $data = $request->all();

      $validateData = $request->validate([
        'email'=> 'required|email|max:255',
        'content'=> 'required|max:2000',
      ]);

      $new_message = new Message();
      $new_message->email= $data['email'];
      $new_message->message_content = $data['content'];
      $new_message->apartament_id = $data['id'];
      $new_message->save();
      Mail::to($data['email'])->send(new InfoMessage);
      return view('apartaments.confirm_msg');
    }

    public function sendMessage()
    {

      Mail::to(Auth::id()->email)->send(new InfoMessage(Auth::id()->email));

      if (Mail::failures())
      {
        return response()->Fail('Sorry! Please try again latter');
      } else {
           return response()->success('Great! Successfully send in your mail');
        }
    }
}
