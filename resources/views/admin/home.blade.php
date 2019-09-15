@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h5>Dashboard</h5> </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @role("UPRA")
                    <a href='{{ route('admin.apt.index') }}'>Vedi i tuoi appartamenti</a>
                    <a href='{{ route('admin.message.index') }}'>Vedi i tuoi messaggi</a>
                    <span>Hai effettuato l'accesso correttamente!</span>

                  @role("UPRA")

                    <div class="mt-3 mb-3">
                      <span class="show_apt mr-2">

                        <a href='{{ route('admin.apt.index') }}'>
                          <button type="button" class="btn btn-primary">Vedi appartamenti</button> </a>


                      </span>
                        <span class="show_messagges">

                          <a href=
                          {{-- '{{ route('admin.apt.message') }}' --}}
                          > <button type="button" class="btn btn-primary">Vedi messaggi</button> </a>

                        </span>
                    </div>
                    @endrole

                    @role("UPR")
                      <div class="mb-3">

                        <a href='{{ route('admin.apt.create') }}'>
                          <button type="button" class="btn btn-primary">Registra appartamento</button> </a>

                        {{-- <a href="{{ route('admin.apt.create') }}" class="button">Registra appartamento</a> --}}

                    </div>
                    @endrole




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
