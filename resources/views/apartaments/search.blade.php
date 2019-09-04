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


    <div class="container-fluid search">
        <div class="searchboxes search__checkbox">
            @foreach ($services as $service)
                
            <label class="form-check-label search__checkbox--label" for="{{ $service['id'] }}">
                  <input 
                    id="{{ $service['id'] }}" 
                    name="services[]" 
                    value="{{ $service->id }}"
                    type="checkbox"> 
                  {{ $service['description'] }} 
                </label>
            @endforeach
        </div>
        <div id="search">
            {{-- Vue manages the code in here --}}
        </div>
    </div>
@endsection 