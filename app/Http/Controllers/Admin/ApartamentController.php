<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartament;
use App\Service;
use App\Sponsor;
use Carbon\Carbon;


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
      $validator = $request->validate([
        "title" => "required|unique:apartaments|bail|max:255",
        "rooms" => "required|numeric|min:1",
        "beds" => "required|numeric|min:1",
        "baths" => "required|numeric|min:1",
        "square_mt" => "required|numeric|min:10",
        "apt_pic" => "required|image|max:255",
        "address" => "required|max:255",
        "long" => "required|numeric",
        "lat" => "required|numeric",
      ]);


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

        return redirect()->route("admin.apt.index");

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $apartament = Apartament::find($id);
        $sponsor =
        Sponsor::where('apartament_id',$apartament->id)->get();
        $services = Service::all();
        return view('admin.edit', compact('apartament', 'services','sponsor'));
    }

    public function update(Request $request, $id)
    {

      $validator = $request->validate([
        "title" => "required|max:255",
        "rooms" => "required|numeric|min:1",
        "beds" => "required|numeric|min:1",
        "baths" => "required|numeric|min:1",
        "square_mt" => "required|numeric|min:10",
        "address" => "required|max:255",
        "long" => "required|numeric",
        "lat" => "required|numeric",
      ]);

        $data = $request->all();
        $upd_apt = Apartament::find($id);

        $upd_apt->user_id = Auth::user()->id;
        $upd_apt->title = $data["title"];
        $upd_apt->total_rooms = $data["rooms"];
        $upd_apt->total_beds = $data["beds"];
        $upd_apt->total_baths = $data["baths"];
        $upd_apt->square_meters = $data["square_mt"];
        $upd_apt->visible = 1;
        if(!empty($data["apt_pic"])) {
          $photo = Storage::put("apt_pic", $data["apt_pic"]);
          $upd_apt->image_url = $photo;
        }
        $upd_apt->address = $data["address"];
        $upd_apt->long = $data["long"];
        $upd_apt->lat = $data["lat"];

        $upd_apt->update();

        $upd_apt->services()->sync( $data['services'] );

        return redirect()->route("admin.apt.index");
    }

    public function destroy($id)
    {
        $aptToDelete = Apartament::find($id)->delete();
        return redirect()->route('admin.apt.index');
    }

}
