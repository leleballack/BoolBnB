@extends('layouts.app')

@section('content')
    <div class="error">
        <div class="error__content">
            <img src="{{ asset('img/403.png') }}" alt="Pagina di errore" class="error__image">
            <h3 class="heading--tertiary error__description">Accesso negato!  </h3>
            <a href="{{ route('home') }}" class="button button--blue button--animated error__redirect"> Vai alla homepage </a>
        </div>
    </div>
@endsection
