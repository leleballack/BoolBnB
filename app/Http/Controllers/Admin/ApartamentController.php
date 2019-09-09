<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Apartament;
use App\User;
use App\Service;
use App\Sponsor;
use App\Role;

use Carbon\Carbon;

class ApartamentController extends Controller
{

  public function __construct() {

  $this->middleware('role:UPRA', ['only' => ['edit', 'delete']]);
  }

    public function index()
    {

      $user_id = Auth::user()->id;
      $apartaments = Apartament::where('user_id', $user_id)->get();

      $arr = [];
      $arr_2 = [];
      foreach ($apartaments as $apartament) {
        $apart_id = $apartament->id;
        $sponsor = Sponsor::where('apartament_id', $apart_id)->get();

        foreach ($sponsor as $s) {
          $variabile = Carbon::parse($s['end_date']);
          $now = Carbon::now();

          if( $variabile  > Carbon::now() ) {

            $cur_id = $s['apartament_id'];
            $cur_date = $s['end_date'];

            // arr_2
            $cur_dt = [
              'cur_id' => $cur_id,
              'cur_date' => $variabile
            ];
            array_push($arr, $cur_id);
            array_push($arr_2, $cur_dt);

            dump($arr);
            dump($arr_2);
          }
        }
      }

      return view('admin.index', compact('apartaments','sponsor','arr','arr_2','now'));
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
        if (!Auth::user()->hasRole("UPRA"))
        {
          Auth::user()->detachRole(Role::where('name','UPR')->first());
          Auth::user()->attachRole(Role::where('name','UPRA')->first());
        };
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

        if(isset($data['services'])) 
        {
        $new_apt->services()->sync( $data['services'] );
        }

        return redirect()->route("admin.apt.index");

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $apartament = Apartament::where('user_id', Auth::id())->findOrFail($id);

        $sponsor = Sponsor::where('apartament_id',$apartament->id)->get();
        $services = Service::all();
        $now = Carbon::now();

        foreach ($sponsor as $s) {
          $variabile = Carbon::parse($s->end_date);
          if(($variabile)->greaterThan($now)){
            $bool = true;
          }
          else{
            $bool = false;
          }
        }

        return view('admin.edit', compact('apartament', 'services','sponsor', 'bool', 'owner'));

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

        $user_id = Auth::user()->id;
        $apartaments = Apartament::where('user_id', $user_id)->get();
        if ($apartaments->isEmpty()) {
          Auth::user()->detachRole(Role::where('name','UPRA')->first());
          Auth::user()->attachRole(Role::where('name','UPR')->first());
        };

        return redirect()->route('admin.apt.index');
    }

}
