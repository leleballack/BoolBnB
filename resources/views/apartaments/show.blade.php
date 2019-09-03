@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="img_container">
        <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="" width="300" height="300">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul>
          <li style="text-overflow:ellipsis">
            Descrzione: {{$apartament->title}}
          </li>
          <li>
            Stanze: {{$apartament->total_rooms}}
          </li>
          <li>
            Letti: {{$apartament->total_beds}}
          </li>
          <li>
            Bagni: {{$apartament->total_baths}}
          </li>
          <li>
            Superficie {{$apartament->square_meters}}(mq)
          </li>
          <li>
            Indirizzo: {{$apartament->address}}
          </li>
        </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-6">
          {{-- <div id='map'></div> --}}
      </div>
      <div class="col-md-6">
        <h4>Per contattare il proprietario manda un messaggio</h4>
        <form class="" action="{{route('message.store' )}}" method="post">
          @csrf
          <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="email" name="email" value="" placeholder="Inserisci la tua email">
          </div>
          <div class="form-group">
            <label for="content">Messaggio:</label>
            <textarea name="content" rows="8" cols="80" placeholder="Scrivi il tuo messaggio..." value=""></textarea>
          </div>
          <div class="form-group">
            <textarea name="id" rows="1" cols="1" readonly>{{$apartament->id}}</textarea>
          </div>
          <input type="submit" name="" value="Invia Messaggio" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
@endsection
