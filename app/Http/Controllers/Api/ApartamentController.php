<?php

namespace App\Http\Controllers\Api;

use App\Apartament;
use App\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ApartamentController extends Controller
{

    public function filter(Request $request) 
    {
        // se non ci sono parametri passati (o c'è solo la paginazione) => ritorna tutto paginato
        if( count($request->all()) === 0 || $request->has('page') ) {
            return response()->json(Apartament::paginate(6)); 
        }

        // filter by Radius: default vaue = 20 ( km )
        $radius = $request['radius'] | 20;

        // new query instance
        $apartament = Apartament::query(); 

        // filter by radius( query )
        if($request->has('lat') && $request['lat'] !== 'null' && $request->has('long') && $request['long'] !== 'null') {
            $startLat = $request['lat'];
            $startLong = $request['long']; 
            $earth_radius = 6371;

            $apartaments =  $apartament->selectRaw('`id`, `title`, `total_rooms`, `total_beds`, `total_baths`, `square_meters`, `image_url`, `address`, `long`, `lat`, `visible`,
                    ( (' . $earth_radius . ') * acos( cos( radians(' . $startLat . ') ) * 
                    cos( radians( `lat` ) ) * cos( radians( `long` ) - radians(' . $startLong . ') ) + 
                    sin( radians(' . $startLat . ') ) *
                    sin( radians( `lat` ) ) ) )
                 AS distance'
            )
            ->havingRaw("distance < ?", [$radius]);
        }

        // filter by services( array of elements( IDs ) )
        if($request->has('services') && count($request['services']) > 0) {
            $services = $request['services'];

            $apartaments = $apartament->whereHas('services', function($q) use ($services)
            {
                $q->whereIn('id', $services);
            }, '=', count($services));
        }

        return count($apartaments->get()) > 6 ? response()->json($apartaments->paginate(6)) : response()->json($apartaments->get());
    }


    public function getServicesList()
    {
        $services = Service::all();
        return response()->json($services); 
    }

}
