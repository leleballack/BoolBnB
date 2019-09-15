<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;


class InfoMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {

    }


    public function build(Request $request)
    {
      $data = $request->all();
      return $this->from('info@boolbnb.com')->view('admin.welcome');
    }
}
