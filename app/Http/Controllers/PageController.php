<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartament;

class PageController extends Controller
{
    public function showHomePage()
    {
        $sponsoredIDs = Apartament::whereHas('sponsors')
        ->get()
        ->pluck('id')
        ->toArray(); 

        $apartament = Apartament::query(); 

        $sponsoredApartaments = $apartament
            ->where('visible', '=', '1')
            ->orderByRaw('FIELD (id, ' . implode(', ', $sponsoredIDs) . ') DESC')
            ->paginate(9);
        
        return view('homepage', compact('sponsoredApartaments', 'sponsoredIDs'));
    }

    public function showSearchPage()
    {
        return view('apartaments.search'); 
    }
}

