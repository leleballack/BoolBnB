@extends('layouts.app')

@section('scripts')
  <!-- Scripts -->
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/map.css'/>
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/elements.css'/>
  <script src='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/js/form.js'></script>
  <script src='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/tomtom.min.js'></script>
  <script src="{{ asset('js/editAptMap.js') }}" defer></script>
@endsection

@section ('content')

<div class="container">
  <form action="{{ route("admin.apt.update", $apartament->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="form-group">
      <label>Title</label>
      <input name="title" type="text" value="{{ old('title', $apartament->title) }}" class="form-control" placeholder="Title">
    </div>
    <div class="form-group">
      <label>Rooms</label>
      <input name="rooms" type="number" class="form-control" placeholder="Rooms" value="{{ old('rooms', $apartament->total_rooms) }}">
    </div>
    <div class="form-group">
      <label>Beds</label>
      <input name="beds" type="number" class="form-control" placeholder="Beds" value="{{ old('beds', $apartament->total_beds) }}">
    </div>
    <div class="form-group">
      <label>Baths</label>
      <input name="baths" type="number" class="form-control" placeholder="Baths" value="{{ old('baths', $apartament->total_baths) }}">
    </div>

    <div class="form-group">
      <label>Square Mt</label>
      <input name="square_mt" type="number" class="form-control" placeholder="Square Mt" value="{{ old('square_mt', $apartament->square_meters) }}">
    </div>

    <div class="form-check">
      @foreach ($services as $service)
        <label class="form-check-label" for="{{ $service['id'] }}">
            @php
                $array = ($apartament->services)->pluck('id')->toArray();
            @endphp
          <input 
            id="{{ $service['id'] }}" 
            name="services[]" 
            value="{{ $service->id }}"
            {{ ( in_array($service->id, old('services', $array)) ) ? 'checked ' : '' }} 
            type="checkbox"> 
          {{ $service['description'] }} 
        </label>
      @endforeach 
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-lg-9">
            <div class="form-group">
                <input name="apt_pic" type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile">
                <small id="fileHelp" class="form-text text-muted">L'immagine attuale è quella sulla destra. Se desideri cambiarla, scegli un'altro file (sotto i 2 MB).</small>
            </div>
        </div>
        <div class="col-lg-3">
            <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="" width="150" height="150">
        </div>
    </div>

    <div class="form-group">
      <input class="form-control" type="text" id="address" placeholder="Indirizzo..." name="address" value="{{ old('address', $apartament->address) }}" readonly>
    </div>

    <div>
      <div id='map'></div>
    </div>

    {{-- lat e long hidden --}}
    <input type="hidden" id="lat" name="lat" value="{{ old('lat', $apartament->lat) }}">
    <input type="hidden" id="long" name="long" value="{{ old('long', $apartament->long) }}">
    {{-- --- --}}
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
