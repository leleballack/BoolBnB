@extends('layouts.app')

@section ('content')

  @if($apartaments->isNotEmpty())
    <div class="container">
      tutti gli appartamenti
    </div>
  @else
    <a href="{{ route('admin.apt.create') }}" class="button">Registra appartamento</a>
  @endif
  @foreach ($apartaments as $apartament)
    <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="">
  @endforeach


@endsection
