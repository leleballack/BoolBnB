@extends('layouts.app')

@section ('content')

  @if($tutti_gli_apt->isNotEmpty())
    <div class="container">
      <a href="{{ route('admin.apt.create') }}" class="btn btn-primary mt-5 mb-5">Registra un nuovo appartamento</a>
      {{-- <a href="{{ route('admin.home') }}" class="btn btn-primary mt-5 mb-5">Torna alla dashboard</a> --}}
      @foreach ($tutti_gli_apt as $apartament)
        <div class="row mb-5">
          <div class="col-lg-3">

            <img src="{{ asset('storage/' . $apartament->image_url) }}" alt="" width="270" height="270">
          </div>
          <div class="col-lg-6">
            <h3 class="admin__apartament--title">{{$apartament->title}}</h3>
            <h5 class="admin__apartament--address">{{$apartament->address}}</h5>

            <div class="admin__apartament--buttons mt-5 mb-3">
              <span class="mr-2"><a href="{{ route('admin.apt.edit', $apartament->id) }}" class="btn btn-primary">Modifica</a></span>
              <span class="mr-2"><a class="btn btn-secondary" href="{{route('post.show',$apartament->id)}}">Statistiche</a></span>
              <span class="mt-3 mb-3"> <form class="admin__apartament--delete_form" action="{{ route('admin.apt.destroy', $apartament->id) }}" method="post">
                  @method('DELETE')
                  @csrf
                  <input class="btn btn-danger mb-10" type="submit" value="Elimina">
                </form> </span>

                @if (in_array($apartament->id, $arr))
                  @foreach ($arr_2 as $a)
                    @if (($a['cur_id'] === $apartament->id) && ($a['cur_date'] > $now))

                      <div class="admin__apartament--button_sponsor_text mt-3">
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
                      </div>

                    @endif
                  @endforeach
                @else
                  <div>
                    <a class="btn btn-success mt-3" href="{{route('paymentOne', $apartament->id)}}">Sponsorizza</a>
                  </div>
                @endif
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
