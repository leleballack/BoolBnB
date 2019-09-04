



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

<div class="container">

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
      <label>Title</label>
      {{-- <textarea name="title" rows="2" cols="80" class="form-control"></textarea> --}}
      <input name="title" type="text" value="{{ old('title') }}" class="form-control" placeholder="Title">
    </div>
    <div class="form-group">
      <label>Rooms</label>
      <input name="rooms" type="number" value="{{ old('rooms') }}" class="form-control" placeholder="Rooms">
    </div>
    <div class="form-group">
      <label>Beds</label>
      <input name="beds" type="number" value="{{ old('beds') }}" class="form-control" placeholder="Beds">
    </div>
    <div class="form-group">
      <label>Baths</label>
      <input name="baths" type="number" value="{{ old('baths') }}" class="form-control" placeholder="Baths">
    </div>

    <div class="form-group">
      <label>Square Mt</label>
      <input name="square_mt" type="number" value="{{ old('square_mt') }}" class="form-control" placeholder="Square Mt">
    </div>

    <div class="form-check">
      @foreach ($services as $service)
        <label class="form-check-label" for="{{ $service['id'] }}">
          <input id="{{ $service['id'] }}" name="services[]" value="{{ $service->id }}" {{ (in_array($service->id, old("services", array()))) ? "checked" : "" }} type="checkbox">
          {{ $service['description'] }}
        </label>
      @endforeach
    </div>

    <div class="form-group">
        <input name="apt_pic" type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile">
        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
    </div>

    <div class="form-group">
      <input class="form-control" type="text" value="{{ old('address') }}" id="address" placeholder="Indirizzo..." name="address" value="" readonly>
    </div>

    <div>
      <div id='map'></div>
    </div>

    {{-- lat e long hidden --}}
    <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">
    <input type="hidden" id="long" name="long" value="{{ old('long') }}">
    {{-- --- --}}
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
