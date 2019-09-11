<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartament;

class PageController extends Controller
{

    public function showAdminHomePage()
    {
        return view('admin.home');
    }
}

