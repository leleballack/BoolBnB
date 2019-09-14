@extends('layouts.app')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<script src="{{ asset('js/messages.js') }}" charset="utf-8"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
@endsection

@section('content')
<div class="container">
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
                      <input type="hidden" value="{{$message->id}}" name="data-name"/>
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5 class="contacts"> {{$message->email}} <span class="chat_date">{{ $message->created_at->format('M d, H:m') }}</span></h5>
                                <form action="{{ route('admin.message.destroy', $message->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input value="&#xf2ed;" class="btn btn-danger far fa-trash-alt float-right" type="submit">
                                </form>
                                    <p  class="apt_title"><strong>{{ Str::words($message->apartament->title,4) }}</strong> </p>
                                    <p>{{ Str::words($message->message_content,3) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mesgs">


                <div class="msg_history active_chat" data-attribute={{ 1 }}>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p class="content">{{($message->message_content)}}</p>
                                <span class="time_date"> {{($message->created_at->format('M d | H:m'))}}</span>
                            </div>
                        </div>
                    </div>



                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p class="content">Re: {{ $message->email }} <br>
                              Grazie per il tuo messaggio. Ti risponderò appena possibile</p>
                            <span class="time_date"> {{now()->format('M d | H:m')}}</span>
                        </div>
                    </div>

                    {{-- <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>Test, which is a new approach to have</p>
                  <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
              </div>
            </div> --}}
                    {{-- <div class="outgoing_msg">
              <div class="sent_msg">
                <p>Apollo University, Delhi, India Test</p>
                <span class="time_date"> 11:01 AM    |    Today</span> </div>
            </div> --}}
                    {{-- <div class="incoming_msg">
              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>We work directly with our designers and suppliers,
                    and sell direct to you, which means quality, exclusive
                    products, at a price anyone can afford.</p>
                  <span class="time_date"> 11:01 AM    |    Today</span></div>
              </div>
            </div> --}}



                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message" />
                        <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="template">
      <div class="msg_history" data-attribute="">
       <div class="outgoing_msg">
          <div class="sent_msg">
           <p class="content">Re: {{ $message->email }} <br></p>
           <span class="time_date">{{now()->format('M d | H:m')}}</span>
          </div>
       </div>
   </div>

  </div>
</div>







@endsection
