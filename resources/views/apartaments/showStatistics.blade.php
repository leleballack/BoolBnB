@extends('layouts.app')
@section('content')
<canvas id="myChart" width="200" height="200"></canvas>
<input id="gen" type="text" name="" value="{{$risultati[0]}}">
<input id="feb" type="text" name="" value="{{$risultati[1]}}">
<input id="mar" type="text" name="" value="{{$risultati[2]}}">
<input id="apr" type="text" name="" value="{{$risultati[3]}}">
<input id="mag" type="text" name="" value="{{$risultati[4]}}">
<input id="giu" type="text" name="" value="{{$risultati[5]}}">
<input id="lug" type="text" name="" value="{{$risultati[6]}}">
<input id="ago" type="text" name="" value="{{$risultati[7]}}">
<input id="set" type="text" name="" value="{{$risultati[8]}}">
<input id="ott" type="text" name="" value="{{$risultati[9]}}">
<input id="nov" type="text" name="" value="{{$risultati[10]}}">
<input id="dic" type="text" name="" value="{{$risultati[11]}}">



<script src="{{ asset('js/charts.js') }}"></script>
@endsection
