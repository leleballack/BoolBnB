<?php

namespace App\Http\Controllers\Api;

use App\Apartament;
// use App\Service;
// use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApartamentController extends Controller
{
    public function index()
    {
        $apartaments = Apartament::paginate(12);

        return response()->json($apartaments); 
    }

}
