@extends('layouts.app')

@section ('content')

<div class="container">
  <form action="{{ route("admin.apt.store") }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label>Title</label>
      {{-- <textarea name="title" rows="2" cols="80" class="form-control"></textarea> --}}
      <input name="title" type="text" name="" value="" class="form-control" placeholder="Title">
    </div>
    <div class="form-group">
      <label>Rooms</label>
      <input name="rooms" type="number" class="form-control" placeholder="Rooms">
    </div>
    <div class="form-group">
      <label>Beds</label>
      <input name="beds" type="number" class="form-control" placeholder="Beds">
    </div>
    <div class="form-group">
      <label>Baths</label>
      <input name="baths" type="number" class="form-control" placeholder="Baths">
    </div>
    <div class="form-group">
      <label>Square Mt</label>
      <input name="square_mt" type="number" class="form-control" placeholder="Square Mt">
    </div>
    {{-- <input type="checkbox" name="services" value=""> --}}
    {{-- <div class="form-group">
      <label>Address</label>
      <input name="via" type="text" class="form-control" placeholder="Street name">
      <input name="numero_civico" type="text" class="form-control" placeholder="Street number">
      <input name="cap" type="text" class="form-control" placeholder="Post Code">
      <input name="citta" type="text" class="form-control" placeholder="City"> --}}



    <div class="form-group">
        <input name="apt_pic" type="file" class="form-control-file" name="fileToUpload" id="exampleInputFile">
        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@endsection
