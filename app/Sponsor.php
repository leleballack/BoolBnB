<?php

namespace App;

use App\Apartament; 
use App\Sponsortype; 
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function apartament()
    {
        return $this->belongsTo('Apartament'); 
    }

    public function sponsortype()
    {
        return $this->belongsTo('Sponsortype');
    }
}
