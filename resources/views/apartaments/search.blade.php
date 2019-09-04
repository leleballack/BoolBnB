@extends('layouts.app')

@section('scripts')
  <script src="{{ asset('js/aptSearch.js') }}" defer></script>
@endsection

@section('content')
    <div class="intro">
        <div class="intro__content">
            <h2 class="intro__text">Scegli il punto di interesse</h2>
            
            <select class="intro__select" name="city_select" id="selectedCity">
                <option value="Milano">Milano</option>
                <option value="Bologna">Bologna</option>
                <option value="Firenze">Firenze</option>
                <option value="Roma">Roma</option>
            </select>
        </div>
    </div>


    <div class="container">
        <div id="search">
            {{-- Vue manages the code in here --}}
        </div>
    </div>
@endsection 