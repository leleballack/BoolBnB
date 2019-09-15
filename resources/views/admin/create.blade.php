



@extends('layouts.app')

@section('scripts')
  <!-- Scripts -->
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/map.css'/>
  <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/elements.css'/>
  <script src='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/js/form.js'></script>
  <script src='https://api.tomtom.com/maps-sdk-js/4.47.6/examples/sdk/tomtom.min.js'></script>
  <script src="{{ asset('js/createAptMap.js') }}" defer></script>
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

        <form action="{{ route("admin.apt.store") }}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label>Titolo</label>
            {{-- <textarea name="title" rows="2" cols="80" class="form-control"></textarea> --}}
            <input name="title" type="text" value="{{ old('title') }}" class="form-control" placeholder="Titolo">
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
          <input name="rooms" type="number" value="{{ old('rooms') }}" class="form-control" placeholder="Stanze">
          @error('rooms')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Letti</label>
          <input name="beds" type="number" value="{{ old('beds') }}" class="form-control" placeholder="Letti">
          @error('beds')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Bagni</label>
          <input name="baths" type="number" value="{{ old('baths') }}" class="form-control" placeholder="Bagni">
          @error('baths')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
          <label>Metri quadri</label>
          <input name="square_mt" type="number" value="{{ old('square_mt') }}" class="form-control" placeholder="Metri quadri">
          @error('square_mt')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>
    <div class="row mt-5 mb-5">

      <div class="form-check">
        @foreach ($services as $service)

        <label
          for="{{ $service->id }}"
          class="form-check-label search__checkbox--label mr-3"
        >
          <input
            name="services[]"
            type="checkbox"
            id="{{ $service->id }}"
            value="{{ $service->id }}"
            class="search__checkbox--quad"
            {{ ( in_array($service->id, old('services', array())) ) ? 'checked ' : '' }}
          >
          {{ $service->description }}
        </label>

        @endforeach
      </div>

    </div>
    <div class="row mt-3 mb-5">
      <div class="col-lg-8">
        <div class="form-group">
          <label class="upload" for="upload-photo">
            Carica immagine
          </label>
            <input name="apt_pic" type="file" class="form-control-file" name="fileToUpload" id="upload-photo">
            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
            @error('apt_pic')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input class="form-control" type="text" value="{{ old('address') }}" id="address" placeholder="Indirizzo..." name="address" value="" readonly>
          @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <div id='map'></div>
        </div>

        {{-- lat e long hidden --}}
        <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">
        <input type="hidden" id="long" name="long" value="{{ old('long') }}">

      </div>
    </div>
    {{-- ---Visibility--- --}}
    <div class="row mt-3 mb-3">
      <div class="col-lg-12">
        <p>Vuoi che questo appartamento sia visibile al pubblico?</p>
        <div class="form-check form-check-inline">
          <label for="radio1">
            <div class="custom-control custom-radio">
              <input name="visibility" type="radio" id="radio1" value="1" checked class="custom-control-input">
              <label class="custom-control-label" for="customRadio">  Visibile</label>
            </div>
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label for="radio2">
            <div class="custom-control custom-radio">
              <input name="visibility" type="radio" id="radio2" value="0"
              class="custom-control-input">
              <label class="custom-control-label" for="customRadio">Nascosto</label>
            </div>
          </label>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>


@endsection
