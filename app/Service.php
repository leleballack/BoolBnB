<?php

namespace App;

use App\Apartament; 
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function apartaments()
    {
        return $this->belongsToMany('Apartament');
    }
}
