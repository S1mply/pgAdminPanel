@extends('dashboard')

@section('content')
    <div id="user_id" style="display: none">{{$user->id}}</div>
    <div id="second_user_id" style="display: none">{{$second_user->id}}</div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chat</h3>
                    <div class="box-tools pull-right">
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages"  style="height: 600px;">

                        @foreach($message as $main_message)
                            @if($main_message->sender_user_id == $user->id)
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">{{$user->name or 'none'}}</span>
                                        <span class="direct-chat-timestamp pull-left">{{$main_message->created_at or 'none'}}</span>
                                    </div><!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{$profile->avatar or 'none'}}" alt="message user image"><!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" style="float: right;max-width:75%;word-wrap: break-word">
                                        {{$main_message->message or ''}}
                                    </div><!-- /.direct-chat-text -->
                                </div><!-- /.direct-chat-msg -->
                            @else
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">{{$second_user->name or 'none'}}</span>
                                        <span class="direct-chat-timestamp pull-right">{{$main_message->created_at or 'none'}}</span>
                                    </div><!-- /.direct-chat-info -->
                                    <img class="direct-chat-img" src="{{$second_profile->avatar or 'none'}}" alt="message user image"><!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" style="float: left;max-width:75%;word-wrap: break-word">
                                        {{$main_message->message or ''}}
                                    </div><!-- /.direct-chat-text -->
                                </div><!-- /.direct-chat-msg -->
                            @endif


                        @endforeach
                        </div><!-- /.direct-chat-msg -->
                    </div><!--/.direct-chat-messages-->
                    <div id="typing"></div>
                <div class="box-footer">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control" id="message" autofocus data-token="{{ csrf_token() }}" onblur="noTyping()">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat" id="send">Send</button>
                      </span>
                        </div>
                </div><!-- /.box-footer-->
            </div><!--/.direct-chat -->
        </div>
    </div>
    </div>


    <script src="{{asset('cssjs/chat.js')}}"></script>
    <script src="{{asset('cssjs/jquery.scrollTo.min.js')}}"></script>
@stop