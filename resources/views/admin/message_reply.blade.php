@extends('layouts.app')
@section('content')
<div class="container text-center">
  <div class="row">
      <div class="card col-lg-5">
        <div class="card-header">
          From: {{ $message->email }}
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>"{{ $message->message_content }}"</p>
            <footer class="blockquote-footer">{{ $message->created_at }}</footer>
          </blockquote>
        </div>
        <small><em>Il messaggio ricevuto verrà automaticamente cancellato dopo l'invio del messaggio di risposta</em> </small>
      </div>

      <div class="reply col-lg-5">
          <form class="" action="{{route('admin.send_msg')}}" method="post">
              @csrf
              <div class="form-group">
                  <label for="email">Email:</label>
                  <input class="form-control" type="email" name="email" value="{{ $message->email }}" placeholder="Inserisci la tua email">
              </div>
              <div class="form-group">
                  <label for="content">Messaggio:</label>
                  <textarea name="content" style='width:100%' rows='8' placeholder="Scrivi il tuo messaggio..." value=""></textarea>
              </div>
              <div class="form-group">
                  <input type="hidden" name="id" value="{{$message->id}}">
              </div>
              <input type="submit" name="" value="Invia Messaggio" class="btn btn-success">
          </form>
      </div>

</div>

@endsection
