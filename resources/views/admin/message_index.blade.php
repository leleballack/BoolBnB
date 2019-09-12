@extends('layouts.app')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@endsection

@section('content')
  <div class="container">

{{--
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
    @endforeach --}}

    <div class="mail-box">
      <aside class="sm-side">
          <div class="user-head">
              <div class="user-name">
                  <h5> {{ Auth::user()->name }} </h5>
                  <span> {{ Auth::user()->email }} </span>
              </div>
          </div>
          <div class="inbox-body">


          </div>
          <ul class="inbox-nav inbox-divider">
            <li class="active">
                <a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>

            </li>
            <li>
                <a href="#"><i class="fa fa-envelope-o"></i> Sent Mail</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bookmark-o"></i> Important</a>
            </li>
            <li>
                <a href="#"><i class=" fa fa-external-link"></i> Drafts <span class="label label-info pull-right">30</span></a>
            </li>
            <li>
                <a href="#"><i class=" fa fa-trash-o"></i> Trash</a>
            </li>
        </ul>



      </aside>
      <aside class="lg-side">
          <div class="inbox-head">
              <h3>Inbox</h3>
          </div>
          <div class="inbox-body">

              <table class="table table-inbox table-hover">
                <tbody>
                  <thead class="text-center">
                    <tr>
                      <th><i class="fas fa-reply"></i></th>
                      <th><i class="far fa-trash-alt"></i></th>
                      <th>Inserzione</th>
                      <th>Mittente</th>
                      <th>Messaggio</th>
                      <th>Data</th>
                    </tr>
                  </thead>
                  @foreach ($messages as $message)
                    <tr class="read text-center">
                      <td class="inbox-small-cells">
                        <a href="#myModal" data-toggle="modal"  title="Reply"    class="btn btn-reply">
                          Reply
                        </a> </td>
                        <!-- Modal -->
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">To</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="" id="inputEmail1" class="form-control" value="{{ $message->email }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Subject</label>
                                                <div class="col-lg-10">
                                                    <input type="text" placeholder="" id="inputPassword1" class="form-control" value="{{ 'Re: ' . $message->apartament->title }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Message</label>
                                                <div class="col-lg-10">
                                                    <textarea rows="10" cols="30" class="form-control" id="" name="" ></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-send" type="submit">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                      <td class="inbox-small-cells"><form action="{{ route('admin.message.destroy', $message->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <input class="btn btn-danger mb-10" type="submit" value="Cancella">
                          </form> </td>
                      <td>{{ Str::words($message->apartament->title,2) }}</td>
                      <td class="view-message dont-show">{{ $message->email }}</td>
                      <td class="view-message">{{ Str::words($message->message_content,3) }}</td>
                      <td class="view-message text-right">{{ $message->created_at->format('M d, H:m') }}</td>
                    </tr>

                  @endforeach

              </tbody>
              </table>
          </div>
      </aside>
    </div>



  </div> {{-- end container --}}






@endsection
