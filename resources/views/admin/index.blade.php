@extends('layouts.app')

@section ('content')

  @if($apartaments->isNotEmpty())
    <div class="container">
      tutti gli appartamenti
    </div>
  @else
    <a href="{{ route('admin.create') }}" class="button">Registra appartamento</a>
  @endif

@endsection
