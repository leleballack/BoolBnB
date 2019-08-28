<?php

namespace App;

use App\Apartament;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // relationship
    public function apartament()
    {
        return $this->belongsTo('Apartament');
    }
}
