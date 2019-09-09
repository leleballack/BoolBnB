@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="cover">
            <div class="cover__text">
                <h1 class="cover__title">
                    BoolBnB
                </h1>
                <span class="cover__description">
                    Trova l'appartamento perfetto per te
                </span>
                <a class="button button--blue button--animated cover__cta" href="{{ route('search') }}">Cerca</a>
            </div>
        </div>

    </section>


@endsection



