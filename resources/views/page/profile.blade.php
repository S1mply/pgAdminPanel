@extends('dashboard')

@section('content')
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Profile</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['method' => 'put','route' => array('profile.update', $profile->user_id),'files' => true]) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('Full Name') !!}
                                {!! Form::text('name',$user->name, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email') !!}
                                {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Password') !!}
                                {!! Form::input('password','password', $user->password, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Company') !!}
                                {!! Form::text('company', $profile->company, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Phone') !!}
                                {!! Form::text('phone', $profile->phone, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Avatar') !!}
                                <img src='{{$profile->avatar}}' style="height: 100px;width: 100px">
                            </div>
                            <div class="form-group">
                                {!! Form::hidden('logo', $profile->avatar) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Change Avatar') !!}
                                {!!Form::file('avatar', ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div><!-- /.box -->
            </div>
        </div>
@stop