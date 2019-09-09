<?php

namespace App;

use App\User;
use App\Message;
use App\Address;
use App\Service;
use App\Sponsor;
use Illuminate\Database\Eloquent\Model;

class Apartament extends Model
{
    // relationship
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function messages()
    {
        return $this->hasMany('Message');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function sponsors()
    {
        return $this->hasMany('App\Sponsor');
    }
}
