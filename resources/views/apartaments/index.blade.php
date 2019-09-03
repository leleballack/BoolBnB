@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @foreach ($apartaments as $apartament)
          <ul>
            <li>
              Descrizione:
              <a href="{{route('apartaments.show',$apartament->id)}}" style="text-overflow:ellipsis">{{$apartament->title}}</a>
              <span>Indirizzo:{{$apartament->address}}</span>
            </li>

          </ul>
        @endforeach
      </div>
    </div>
  </div>
@endsection
