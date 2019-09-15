@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-5">
            Totale visualizzazzioni: {{ $total_views_per_apt }}
        </div>
        <div class="col-lg-5">
            Totale messaggi: {{ $totale_messaggi }}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <canvas id="myChart" width="200" height="200"></canvas>
        </div>
        <div class="col-lg-5">
            <canvas id="messagesChart" width="=200" height="200"></canvas>
        </div>
    </div>
</div>


{{-- visualizzazioni --}}
<input id="gen" type="hidden" name="" value="{{$risultati[0]}}">
<input id="feb" type="hidden" name="" value="{{$risultati[1]}}">
<input id="mar" type="hidden" name="" value="{{$risultati[2]}}">
<input id="apr" type="hidden" name="" value="{{$risultati[3]}}">
<input id="mag" type="hidden" name="" value="{{$risultati[4]}}">
<input id="giu" type="hidden" name="" value="{{$risultati[5]}}">
<input id="lug" type="hidden" name="" value="{{$risultati[6]}}">
<input id="ago" type="hidden" name="" value="{{$risultati[7]}}">
<input id="set" type="hidden" name="" value="{{$risultati[8]}}">
<input id="ott" type="hidden" name="" value="{{$risultati[9]}}">
<input id="nov" type="hidden" name="" value="{{$risultati[10]}}">
<input id="dic" type="hidden" name="" value="{{$risultati[11]}}">


{{-- messaggi per mese --}}

<input id="gen_mes" type="hidden" name="" value="{{$mesi[1]}}">
<input id="feb_mes" type="hidden" name="" value="{{$mesi[2]}}">
<input id="mar_mes" type="hidden" name="" value="{{$mesi[3]}}">
<input id="apr_mes" type="hidden" name="" value="{{$mesi[4]}}">
<input id="mag_mes" type="hidden" name="" value="{{$mesi[5]}}">
<input id="giu_mes" type="hidden" name="" value="{{$mesi[6]}}">
<input id="lug_mes" type="hidden" name="" value="{{$mesi[7]}}">
<input id="ago_mes" type="hidden" name="" value="{{$mesi[8]}}">
<input id="set_mes" type="hidden" name="" value="{{$mesi[9]}}">
<input id="ott_mes" type="hidden" name="" value="{{$mesi[10]}}">
<input id="nov_mes" type="hidden" name="" value="{{$mesi[11]}}">
<input id="dic_mes" type="hidden" name="" value="{{$mesi[12]}}">



<script src="{{ asset('js/charts.js') }}"></script>
<script src="{{ asset('js/chartsMessage.js') }}"></script>
@endsection

