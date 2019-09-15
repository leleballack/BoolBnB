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
<div class="admin_form">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        @endif

        <form action="{{ route("admin.apt.update", $apartament->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label>Titolo</label>
            <input name="title" type="text" value="{{ old('title', $apartament->title) }}" class="form-control" placeholder="Titolo">
            @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Stanze</label>
          <input name="rooms" type="number" class="form-control" placeholder="Stanze" value="{{ old('rooms', $apartament->total_rooms) }}">
          @error('rooms')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Letti</label>
          <input name="beds" type="number" class="form-control" placeholder="Letti" value="{{ old('beds', $apartament->total_beds) }}">
          @error('beds')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Bagni</label>
          <input name="baths" type="number" class="form-control" placeholder="Bagni" value="{{ old('baths', $apartament->total_baths) }}">
          @error('baths')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Metri quadri</label>
          <input name="square_mt" type="number" class="form-control" placeholder="Metri quadri" value="{{ old('square_mt', $apartament->square_meters) }}">
          @error('square_mt')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <div class="row mt-5 mb-5">
      <div class="form-check ">
        @foreach ($services as $service)

        <label
          for="{{ $service->id }}"
          class="form-check-label search__checkbox--label mr-3"
        >
        @php
          $array = ($apartament->services)->pluck('id')->toArray();
        @endphp
          <input
            name="services[]"
            type="checkbox"
            id="{{ $service->id }}"
            value="{{ $service->id }}"
            class="search__checkbox--quad"
            {{ ( in_array($service->id, old('services', $array)) ) ? 'checked ' : '' }}
          >
          {{ $service->description }}
        </label>

        @endforeach
      </div>
    </div>
    <div class="row mt-3 mb-5 ">
      <div class="col-lg-8">
        <div class="form-group">
          <label class="upload" for="upload-photo">
            Carica immagine
          </label>
          <input name="apt_pic" type="file" class="form-control-file" name="fileToUpload" id="upload-photo">
          <small id="fileHelp" class="form-text text-muted">L'immagine attuale è quella sulla destra. Se desideri cambiarla, scegli un'altro file (sotto i 2 MB).</small>
            @error('apt_pic')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      </div>
      <div class="col-lg-4">
        <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="" width="150" height="150">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="form-control" type="text" id="address" placeholder="Indirizzo..." name="address" value="{{ old('address', $apartament->address) }}" readonly>
          @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <div id='map'></div>
        </div>

        {{-- lat e long hidden --}}
        <input type="hidden" id="lat" name="lat" value="{{ old('lat', $apartament->lat) }}">
        <input type="hidden" id="long" name="long" value="{{ old('long', $apartament->long) }}">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        {{-- visibility --}}
        <div class="mt-3 mb-3">
          <p>Vuoi che questo appartamento sia visibile al pubblico?</p>
          <div class="form-check form-check-inline">
            <label for="radio1">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input"name="visibility"
               id="radio1" value="1"
              {{($apartament->visible === 1) ? 'checked' : ''}}>
                <label class="custom-control-label" for="customRadio">Visibile</label>
            </div>
          </div>
          <div class="form-check form-check-inline">
            <label for="radio2">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="visibility"
               id="radio2" value="0"
               {{($apartament->visible === 0) ? 'checked' : ''}}>
                <label class="custom-control-label" for="customRadio">Nascosto</label>
              </div>
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>




      </div>
    </div>

  </div>
</div>


@endsection
