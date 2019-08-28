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

    public function address()
    {
        return $this->hasOne('Address'); 
    }

    public function services()
    {
        return $this->belongsToMany('Service');
    }

    public function sponsors()
    {
        return $this->hasMany('Sponsor');
    }
}
