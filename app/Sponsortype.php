<?php

namespace App;

use App\Sponsor;
use Illuminate\Database\Eloquent\Model;

class Sponsortype extends Model
{
    public function sponsors()
    {
        return $this->hasMany('Sponsor'); 
    }
}
