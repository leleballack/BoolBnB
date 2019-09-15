@extends('layouts.app')

@section ('content')
  @if (session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif
  @if($tutti_gli_apt->isNotEmpty())
    <div class="container container--margin-top">
      <div class="row mb-5">
        <a href="{{ route('admin.apt.create') }}" class="btn btn-success mb-3 mr-5 ml-2">Aggiungi appartamento</a>
        <a href='{{ route('admin.message.index') }}' class="btn btn-warning mb-3">Vedi i tuoi messaggi</a>
      </div>

      @foreach ($tutti_gli_apt as $apartament)
        <div class="row apartament">

          <div class="col-lg-4 apartament__image-container" style="background-image: url('{{ asset('storage/' . $apartament->image_url) }}');"></div>

          <div class="col-lg-8 apartament__features-container">

            <h3 class="apartament__title heading--tertiary heading--transparent">{{$apartament->title}}</h3>

            <div class="row mt-2">
                <div class="col-lg-12">
                  <p class="apartament__feature">
                      {{$apartament->address}}
                  </p>
                </div>
            </div>

            <div class="row mt-2">
              <div class="col-lg-12">
                <span class="apartament__button">
                  <a href="{{ route('admin.apt.edit', $apartament->id) }}" class="btn btn-primary">Modifica</a>
                </span>

                <span class="apartament__button">
                  <a class="btn btn-secondary" href="{{route('post.show',$apartament->id)}}">Statistiche</a>
                </span>

                <span class="apartament__button">
                  <form class="apartament__delete-form" action="{{ route('admin.apt.destroy', $apartament->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger mb-10" type="submit" value="Elimina">
                  </form>
                </span>

                  @if (in_array($apartament->id, $arr))
                  @foreach ($arr_2 as $a)
                    @if (($a['cur_id'] === $apartament->id) && ($a['cur_date'] > $now))

                      <div class="apartament__sponsor-desc--container mt-5">
                        <span class="apartament__sponsor-desc--text">
                          Appartamento sponsorizzato fino al {{$a['cur_date']->day . '-' . $a['cur_date']->month . '-' . $a['cur_date']->year}} alle ore
                          @if ($a['cur_date']->hour == 0)
                            @php
                              $hour = $a['cur_date']->hour . '0'
                            @endphp
                          @endif
  
                          @if ($a['cur_date']->minute == 0)
                            @php
                              $minute = $a['cur_date']->minute . '0'
                            @endphp
                            {{$hour . ':' . $minute}}
                          @endif
                        </span>
                      </div>

                    @endif
                  @endforeach
                @else
                  <p class="apartament__button mt-5">
                    <a class="btn btn-success" href="{{route('paymentOne', $apartament->id)}}">Sponsorizza</a>
                  </p>
                @endif

              </div>
            </div>


          </div>
        </div>

      @endforeach
      <div class="pagination">
          {{ $tutti_gli_apt->links() }}
      </div>
    </div>
  @else

    <div class="container container--margin-top-25 message-link">
      <a class="message-link__register" href="{{ route('admin.apt.create') }}">
        Registra appartamento</a>
      </a>
    </div>

  @endif

@endsection
