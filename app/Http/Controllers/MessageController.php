<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartament;
use App\Message;

class MessageController extends Controller
{

    public function store(Request $request){
      $data = $request->all();

    //   $validateData = $request->validate([
    //     'email'=> 'required|email|max:255',
    //     'content'=> 'required|text|max:2000',
    // ]);
      $new_message = new Message();
      $new_message->email= $data['email'];
      $new_message->message_content = $data['content'];
       $new_message->apartament_id = $data['id'];
      // $new_message->apartament_id = $apart_id;
      $new_message->save();
      dd($data);
    }
}
