@extends('layouts.app')

@section ('content')

  @if($apartaments->isNotEmpty())
    <div class="container">
      tutti gli appartamenti <br>
      <a href="{{ route('admin.apt.create') }}" class="button btn btn-success mt-3 mb-3">Aggiungi appartamento</a>
      @foreach ($apartaments as $apartament)
        <div class="row">
          <div class="col-lg-6">
            <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="" width="300" height="300">
          </div>
          <div class="col-lg-6">
            <a href="{{ route('admin.apt.edit', $apartament->id) }}" class="button btn btn-primary">Modifica</a>

            <form action="{{ route('admin.apt.destroy', $apartament->id) }}" method="post">
              @method('DELETE')
              @csrf
              <input class="btn btn-danger mb-10" type="submit" value="Cancella">
            </form>
            {{-- <a href="{{ route('admin.apt.destroy', $apartament->id) }}" class="button btn btn-danger">Cancella</a> --}}
          </div>

        </div>
      @endforeach
    </div>
  @else
    <a href="{{ route('admin.apt.create') }}" class="button">Registra appartamento</a>
  @endif



@endsection
