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

    <section class="section">
        <div class="container homepage">
            <div class="row justify-content-center">
                <h3 class="heading--tertiary heading--transparent homepage__heading">
                    Gli appartamenti in evidenza
                </h3>
            </div>

            <div class="homepage__grid">

                
                @foreach ($sponsoredApartaments as $apartament)
                <a  class="homepage__apartament" href="{{route('apartaments.show',$apartament->id)}}">                
                @if ( in_array( $apartament->id, $sponsoredIDs ) )
                    <span class="homepage__apartament--sponsored">
                        sponsorizzato
                    </span>
                @endif
                    <div class="homepage__apartament--image-container" style="background-image: url( {{ asset('storage/' . $apartament->image_url) }} )"></div>
                    <div class="homepage__apartament--title-container">
                        <span class="homepage__apartament--title">
                            {{ $apartament->title }}
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
            
            <div class="pagination">
                {{ $sponsoredApartaments->links() }}
            </div>
        </div>

        </div>
    </section>

@endsection



