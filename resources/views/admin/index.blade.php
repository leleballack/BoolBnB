@extends('layouts.app')

@section ('content')
  @if (session('success_message'))
    <div class="alert alert-success">
      {{ session('success_message') }}
    </div>
  @endif
  @if($tutti_gli_apt->isNotEmpty())
    <div class="container">
      <a href="{{ route('admin.apt.create') }}" class="btn btn-success mt-3 mb-3">Aggiungi appartamento</a>
      <a href='{{ route('admin.message.index') }}' class="btn btn-warning mt-3 mb-3">Vedi i tuoi messaggi</a>

      <a href="{{ route('admin.apt.create') }}" class="btn btn-primary mt-5 mb-5">Registra un nuovo appartamento</a>

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
    <div class="mt-3">
      <a href="{{ route('admin.apt.create') }}" class="btn btn-primary">Registra appartamento</a>
    </div>

  @endif

@endsection
