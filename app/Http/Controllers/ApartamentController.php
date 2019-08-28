<?php

namespace App\Http\Controllers;

use App\Apartament;
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
    public function show(Apartament $apartament)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartament  $apartament
     * @return \Illuminate\Http\Response
     */
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
}
