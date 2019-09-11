@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @role("UPRA")
                    <a href='{{ route('admin.apt.index') }}'>Vedi appartamenti</a>
                    @endrole

                    @role("UPR")
                    <a href="{{ route('admin.apt.create') }}" class="button">Registra appartamento</a>
                    @endrole


                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
