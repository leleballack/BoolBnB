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
                            <div class="chat_img"> <img src={{asset('storage/' . $message->apartament->image_url)}} alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5 class="contacts"> {{$message->email}} <span class="chat_date">{{ $message->created_at->format('M d, H:m') }}</span></h5>
                                <form action="{{ route('admin.message.destroy', $message->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input value="&#xf2ed;" class="btn btn-danger far fa-trash-alt float-right" type="submit">
                                </form>
                                <a type="button" href="#myModal" data-toggle="modal" title="Reply" name="button" class="btn btn-success far fa-edit float-right"></a>

                                {{-- <a href="#myModal" data-toggle="modal"  title="Reply"    class="btn btn-compose "> --}}

                                    <p  class="apt_title"><strong>{{ $message->apartament->title }}</strong> </p>
                                    <p>{{ $message->message_content }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

  <!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Messaggio di risposta </h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Destinatario</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="" id="inputEmail1" class="form-control" value="{{ $message->email  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Oggetto</label>
                        <div class="col-lg-10">
                            <input type="text" placeholder="" id="inputPassword1" value="{{ $message->apartament->title }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Message</label>
                        <div class="col-lg-10">
                            <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-success" type="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>







@endsection
