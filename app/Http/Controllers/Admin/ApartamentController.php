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
      return view('admin.create', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $new_apt = new Apartament();
        $new_apt->user_id = Auth::user()->id;
        $new_apt->title = $data["title"];
        $new_apt->total_rooms = $data["rooms"];
        $new_apt->total_beds = $data["beds"];
        $new_apt->total_baths = $data["baths"];
        $new_apt->square_meters = $data["square_mt"];
        $new_apt->visible = 1;
        $photo = Storage::put("apt_pic", $data["apt_pic"]);
        $new_apt->image_url = $photo;
        $new_apt->address = $data["address"];
        $new_apt->long = $data["long"];
        $new_apt->lat = $data["lat"];


        $new_apt->save();

        $new_apt->services()->sync( $data['services'] );

        // return dd($new_apt->services());






        return dd($new_apt);


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $apartament = Apartament::find($id);
        $services = Service::all();
        return view('admin.edit', compact('apartament', 'services'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $upd_apt = Apartament::find($id);

        $upd_apt->user_id = Auth::user()->id;
        $upd_apt->title = $data["title"];
        $upd_apt->total_rooms = $data["rooms"];
        $upd_apt->total_beds = $data["beds"];
        $upd_apt->total_baths = $data["baths"];
        $upd_apt->square_meters = $data["square_mt"];
        $upd_apt->visible = 1;
        $photo = Storage::put("apt_pic", $data["apt_pic"]);
        $upd_apt->image_url = $photo;
        $upd_apt->address = $data["address"];
        $upd_apt->long = $data["long"];
        $upd_apt->lat = $data["lat"];

        $upd_apt->update();

        $upd_apt->services()->sync( $data['services'] );
    }

    public function destroy($id)
    {
        $aptToDelete = Apartament::find($id)->delete();
        return redirect()->route('admin.apt.index');
    }

}
