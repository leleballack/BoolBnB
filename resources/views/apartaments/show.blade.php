@extends('layouts.app')

@section('scripts')
  <!-- Scripts -->
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/map.css'/>
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/elements.css'/>
  <script src='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/js/form.js'></script>
  <script src='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/tomtom.min.js'></script>
  <script src="{{ asset('js/publicShowAptMap.js') }}" defer></script>
@endsection

@section('content')
  @if (session('message_send'))
    <div class="alert alert-success">
      {{ session('message_send') }}
    </div>
  @endif
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
            Indirizzo: <span class="apt_address">{{$apartament->address}}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-6">
          <div id='map'></div>
      </div>

    {{-- @if (Auth::user()->id != $apartament->user_id) --}}
      <div class="col-md-6">
        <h4>Per contattare il proprietario manda un messaggio</h4>
        <form class="" action="{{route('save_msg')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="email">Email:</label>

            @if (Auth::user() !== null)
              <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Inserisci la tua email">
            @else
              <input class="form-control" type="email" name="email" value="" placeholder="Inserisci la tua email">
            @endif

          </div>
          <div class="form-group">
            <label for="content">Messaggio:</label>
            <textarea name="content" rows="8" cols="80" placeholder="Scrivi il tuo messaggio..." value=""></textarea>
          </div>
          <div class="form-group">
            <input type="hidden" name="id" value="{{$apartament->id}}">
          </div>
          <input type="submit" name="" value="Invia Messaggio" class="btn btn-danger">
        </form>
      </div>
    {{-- @endif --}}
    </div>
  </div>
@endsection
