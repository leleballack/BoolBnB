<?php

namespace App\Http\Controllers;

use App\Apartament;
use App\Service;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use CyrildeWit\EloquentViewable\Support\Period;
use Carbon\Carbon;
class ApartamentController extends Controller
{
    use Viewable;
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
        $user = User::findOrFail($apartament->user_id);
        $apartaments = Apartament::where('user_id', $apartament->user_id)->get();
        $services  = $apartament->services;

        $expiresAt = now()->addHours(24);
          views($apartament)
              ->delayInSession($expiresAt)
              ->record();
        // views($apartament)->record();
        views($apartament)->count();
        return view('apartaments.show', compact('apartament', 'services','user','apartaments'));
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

    public function showView(Apartament $apartament , $id)
    {
      $apartament = Apartament::where('user_id', Auth::id())->findOrFail($id);
      // Dati primo grafico
      $arr = [];
      for ($i=1; $i < 13; $i++) {
        $now = Carbon::now();
        $month = '2019-'. $i . '-1 00:00:00';


        if ($i == 2) {
          $month_2 = '2019-'. $i . '-28 23:59:59';
        }
        else if ($i==4 || $i==6 || $i==9 || $i==11) {
          $month_2 = '2019-'. $i . '-30 23:59:59';
        }
        else {
          $month_2= '2019-'. $i . '-31 23:59:59';
        }

        $month = (Carbon::parse($month));
        $month_2 = (Carbon::parse($month_2));

        $arr_month = [
          'month' => $month,
          'month_2' => $month_2
        ];
        array_push($arr, $arr_month);

      }

      $risultati =[];
      $risultati_messaggi =[];

      foreach ($arr as $a) {
        $numero_stats = views($apartament)->period(Period::create($a['month'], $a['month_2']))->count();
        array_push($risultati,$numero_stats );
      }

      $mesi = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,
        6 => 0,
        7 => 0,
        8 => 0,
        9 => 0,
        10 => 0,
        11 => 0,
        12 => 0
      ];

      $messages = Message::where('apartament_id' , $apartament->id)->get();
      $latest_message =  Message::where('apartament_id' , $apartament->id)->latest()->first();

      foreach ($mesi as $key => $value) {
        $totale_messaggi = 0;
        foreach ($messages as $message) {
          $totale_messaggi++;
          $created = (Carbon::parse($message['created_at']));
          if ($key == $created->month) {
            $value++;
          }
        }
        $mesi[$key] = $value;
      }

      $total_views_per_apt = views($apartament)->count();

      return view('apartaments.showStatistics', compact('apartament', 'total_views_per_apt', 'totale_messaggi', 'risultati', 'mesi','latest_message'));
    }

}
