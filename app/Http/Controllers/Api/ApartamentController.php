<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Apartament;
use App\Service;
use App\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use CyrildeWit\EloquentViewable\Support\Period;
use Carbon\Carbon;

class ApartamentController extends Controller
{

    public function filter(Request $request)
    {
        // dd($request->all());

        // getting all sponsored apts IDs
        $sponsoredApartaments = Apartament::whereHas('sponsors')
            ->get()
            ->pluck('id')
            ->toArray();

        // new query instance
        $apartament = Apartament::query();

        // se non ci sono parametri passati (o c'è solo la paginazione) => ritorna tutto paginato
        if( count($request->all()) === 0 || ( count($request->all()) === 1 && isset($request['page']) ) ) {
            $apts = $apartament
                ->where('visible', '=', '1')
                ->orderByRaw('FIELD (id, ' . implode(', ', $sponsoredApartaments) . ') DESC');
            return response()->json($apts->paginate(6));
        }

        // raggio passato da frontend altrimenti di default 20km
        $radius = (int)$request['radius'] ?: 20;

        if($request->has('lat') && $request['lat'] !== 'null' && $request->has('long') && $request['long'] !== 'null') {
            $startLat = $request['lat'];
            $startLong = $request['long'];
            $earth_radius = 6371;

            $distance = "($earth_radius * acos(cos(radians($startLat)) * cos(radians(`lat`)) * cos(radians(`long`) - radians($startLong)) + sin(radians($startLat)) * sin(radians(`lat`))))";

            $apartaments =  $apartament->selectRaw("`id`, `title`, `total_rooms`, `total_beds`, `total_baths`, `square_meters`, `image_url`, `address`, `long`, `lat`, `visible`,
                {$distance} AS distance"
            )
            ->whereRaw("{$distance} < ?", [$radius])
            ->orderByRaw('FIELD (id, ' . implode(', ', $sponsoredApartaments) . ') DESC')
            ->orderByRaw('distance', 'ASC');
        }

        // filtering by room number
        if( $request->has('rooms') && $request['rooms'] !== 'null' ) {
            $apartaments = $apartament->where('total_rooms', '>', $request['rooms']);
        }

        // filtering by beds number
        if( $request->has('beds') && $request['beds'] !== 'null' ) {
            $apartaments = $apartament->where('total_beds', '>', $request['beds']);
        }

        // filter by services( array of elements( IDs ) )
        if($request->has('services') && count($request['services']) > 0) {
            $services = $request['services'];

            $apartaments = $apartament->whereHas('services', function($q) use ($services)
            {
                $q
                    ->whereIn('id', $services);
            }, '=', count($services));
        }

        // return ordered results ( sponsored apartaments at the top )
        $apartaments = $apartament
            ->where('visible', '=', '1')
            ->orderByRaw('FIELD (id, ' . implode(', ', $sponsoredApartaments) . ') DESC');

        return response()->json( $apartaments->paginate(6) );
    }


    public function getServicesList()
    {
        $services = Service::all();
        return response()->json($services);
    }

    public function returnSponsoredIDs() {

        // retrieve all sponsored apartaments IDs and send them to the frontend;
        // check in the frontend if the current rendered apartament id is included into this array
        // render a target with 'sponsorizzato' word on those apartaments

        $apartament = Apartament::query();

        $sponsoredApartaments = Apartament::whereHas('sponsors')
            ->get()
            ->pluck('id')
            ->toArray();

        return response()->json($sponsoredApartaments);
    }

    
}
