<?php

namespace App\Http\Controllers;

use App\Apartament;
use App\Service;
use App\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartaments = Apartament::all();
        // return view('welcome', compact('apartments'));
        return view('apartaments.index')->with('apartaments', $apartaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartament  $apartament
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {    
        $apartament = Apartament::findOrFail($id);
        $services  = Service::all();
        
        return view('apartaments.show', compact('apartament', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartament  $apartament
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartament $apartament)
    {
        //
    }


    public function update(Request $request, Apartament $apartament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartament  $apartament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartament $apartament)
    {
        //
    }

    public function showSearchPage()
    {
        $services = Service::all(); 
        return view('apartaments.search', compact('services')); 
    }

}
