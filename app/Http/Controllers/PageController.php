<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showHomePage()
    {
        return view('homepage');
    }

    public function showSearchPage()
    {
        return view('apartaments.search'); 
    }
}
