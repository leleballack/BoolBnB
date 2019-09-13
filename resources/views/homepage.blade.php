@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="cover">
            <div class="cover__text">
                <img class="cover__image" src="img/house.png" alt="House">
                <a class="button button--blue button--animated cover__cta" href="{{ route('search') }}">Cerca appartamenti</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container homepage">
            <div class="homepage__title-container">
                <h2 class="heading--secondary heading--transparent homepage__heading">
                    Gli appartamenti in evidenza
                </h2>
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



