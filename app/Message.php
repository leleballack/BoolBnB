<?php

namespace App;

use App\Apartament;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // relationship
    public function apartament()
    {
        return $this->belongsTo('App\Apartament');
    }
}
