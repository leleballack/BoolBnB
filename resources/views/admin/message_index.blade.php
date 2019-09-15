@extends('layouts.app')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<script src="{{ asset('js/messages.js') }}" charset="utf-8"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
@endsection

@section('content')
  @section('content')
    @if (session('message_send'))
      <div class="alert alert-success">
        {{ session('message_send') }}
      </div>
    @endif
<div class="container container--margin-top">
  <div class="all_mess">
    <h3 class=" text-center">Messaggi Ricevuti</h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>BoolBnB</h4>
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="srch_bar">
                        <div class="stylish-input-group">
                            <input type="text" class="search-bar" placeholder="Search">
                            <span class="input-group-addon">
                                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                            </span> </div>
                    </div>
                </div>
                <div class="inbox_chat">

                    @foreach ($messages as $message)
                    <div class="chat_list" data-attribute={{ $message->id }}>
                        <div class="chat_people">
                            <div class="chat_img"> <img src={{asset('storage/' . $message->apartament->image_url)}} alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5 class="contacts"> {{$message->email}} <span class="chat_date">{{ $message->created_at }}</span></h5>
                                <p class="apt_title"><strong>{{ $message->apartament->title }}</strong> </p>
                                <p>{{ $message->message_content }}</p>
                                <form action="{{ route('admin.message.destroy', $message->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input value="&#xf2ed;" class="btn btn-danger far fa-trash-alt float-right" type="submit">
                                </form>
                                <a href="{{ route("admin.message.show", $message->id) }}" class="btn btn-success far fa-edit float-right"></a>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </div>
</div>







@endsection
