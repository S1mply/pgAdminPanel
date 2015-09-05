@extends('dashboard')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Проекты</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'projectSave']) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('Название') !!}
                        {!! Form::text('name','',['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Клиент') !!}
                        {!! Form::select('client', $client, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Метрика') !!}
                        {!! Form::text('yandex_metrika','',  ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Добавить', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>
@stop