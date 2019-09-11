@extends('layouts.app')

@section('content')
  <div class="container">

    Il suo messaggio è stato inviato con successo
    <img src="http://www2.duvalclerk.com/resources/images/sendSuccess.png" alt="">

    <a class="btn btn-success" href='{{ route('search') }}'>Torna alla pagina di ricerca</a>
  </div>
@endsection
