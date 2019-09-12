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
  <div class="public-show">
    <div class="container">
      <div class="row justify-content-around">
        <div class="col-lg-8 col-sm-10">
          <div class="img_container">
            <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="">
          </div>
          <div class="content_container mt-5">
            <div class="title">
              <h1> {{$apartament->title}} </h1>
              <div class="description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
            </div>
            <div class="row justify-content-between mt-5">
              <div class="col-lg-12">
                <h2> Caratteristiche: </h2>
                <div class="features mt-3">
                  <ul>
                    <li>
                      <i class="fas fa-door-open "></i>
                      <span>
                        Stanze disponibili: {{$apartament->total_rooms}}
                      </span>
                    </li>
                    <li>
                      <i class="fas fa-bed "></i>
                      <span>
                         Letti disponibili: {{$apartament->total_beds}}
                      </span>
                    </li>
                    <li>
                      <i class="fas fa-shower "></i>
                      <span>
                        Bagni disponibili: {{$apartament->total_baths}}
                      </span>
                    </li>
                    <li>
                      <i class="fas fa-home "></i>
                      <span>
                        Superficie: {{$apartament->square_meters}}(mq)
                      </span>
                    </li>
                    <li>
                      <i class="fas fa-map-marker-alt"></i>
                      <span>
                        Indirizzo: {{$apartament->address}}
                      </span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row justify-content-between mt-5">
              <div class="col-lg-5">
                  <h2>Servizi:</h2>
                  <div class="services mt-3">
                  @foreach ($services as $s)
                    <ul>
                      <li>
                        <i class="fas fa-check-circle"></i>
                        <span> {{$s->description}}  </span>
                      </li>
                    </ul>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="row mt-5 justify-content-between">
              <div class="col-lg-10 col-sm-8 apt_address">
                <h1>Posizione:</h1>
                <div id='map' class="mt-4"></div>
              </div>
            </div>
            <div class="row mt-5 justify-content-between">
              <div class="col-lg-10 col-sm-6">
                <h3>
                  Per contattare il proprietario manda un messaggio:
                </h3>
                <form class="message_send" action="{{route('message.store' )}}" method="post">
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
                    <textarea class="form-control" name="content" rows="8" cols="80" placeholder="Scrivi il tuo messaggio..." value=""></textarea>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="id" value="{{$apartament->id}}">
                  </div>
                  <button type="submit" name=""  class="button mt-3">Invia Messaggio</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 ">
          <div class="prenotations">
            <div class="user_name">
              <h4>
                Proprietario : <span> {{ $user->name }}. </span>
              </h4>
              <p>
                Possiede in affitto sulla nostra piattaforma
                <strong>{{ $apartament->count() }}</strong> appartamenti.

                @if ($apartament->count() === 1)
                  Possiede in affitto sulla nostra piattaforma <strong>{{ $apartament->count() }}</strong> appartamento.
                @endif
              </p>
            </div>
            <div class="home_recap mt-5">
              <h5> Casa da {{ $apartament->square_meters }}mq. </h5>
              <ul>
                <li>
                  {{ $apartament->address }}.
                </li>
                <li>
                  @if ( $apartament->total_beds == 1 )
                    {{ $apartament->total_beds }} letto,
                  @else
                    {{ $apartament->total_beds }} letti,
                  @endif

                  @if( $apartament->total_rooms == 1 )
                    {{ $apartament->total_rooms }} stanza,
                  @else
                    {{ $apartament->total_rooms }} stanze,
                  @endif
                </li>
              </ul>
            </div>
            <div class="date mt-4">
              <div class="check">
                <h6> Data Arrivo: </h6>
                <input class="form-control"type="date" name="" value="">
              </div>
              <div class="check mt-3">
                <h6>Data Partenza:</h6>
                <input class="form-control "type="date" name="" value="">
              </div>
              <button class="btn btn-danger mt-4" type="button" name="button">
                Vedi l'Offerta
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
