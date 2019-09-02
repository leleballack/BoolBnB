<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartament;
use App\Service;


class ApartamentController extends Controller
{

    public function index()
    {
      $user_id = Auth::user()->id;
      $apartaments = Apartament::where('user_id', $user_id)->get();
      return view('admin.index', compact('apartaments'));


    }

    public function create()
    {
      $services = Service::all();
      return view('admin.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $new_apt = new Apartament();
        $new_apt->title = $data["title"];
        $new_apt->total_rooms = $data["rooms"];
        $new_apt->total_beds = $data["beds"];
        $new_apt->total_baths = $data["baths"];
        $new_apt->square_meters = $data["square_mt"];
        $new_apt->user_id = Auth::user()->id;
        $new_apt->visible = 1;
        $photo = Storage::put("apt_pic", $data["apt_pic"]);
        $new_apt->image_url = $photo;
        $new_apt->save();





        return dd($data);


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
