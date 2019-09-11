@extends('layouts.app')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
@endsection

@section('content')
  <div class="container">


    Sei nei messaggi


    @foreach ($messages as $message)
      <li>Apt ID: {{ $message->apartament_id }}</li>
      <li>{{ $message->email }}</li>
      <li>{{ $message->message_content }}</li>
      <li>{{ $message->created_at }}</li>

      <li><a class="btn btn-success" href='{{ route('admin.message.show', $message->id) }}'>Vedi</a></li>
      <li>    <form action="{{ route('admin.message.destroy', $message->id) }}" method="post">
            @method('DELETE')
            @csrf
            <input class="btn btn-danger mb-10" type="submit" value="Cancella">
          </form></li>
    @endforeach



   </div>






@endsection
