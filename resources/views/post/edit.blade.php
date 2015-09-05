@extends('app')

@section('content')
    @foreach($posts as $post)
        <h1>Update</h1>
        {!! Form::open(array('method' => 'put', 'route' => array('post.update', $post->id),'files' => true)) !!}
        <div class="form-group">
            {!! Form::label('Slug') !!}
            {!! Form::text('slug',$post->slug, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title') !!}
            {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('excerpt') !!}
            {!! Form::textarea('excerpt', $post->excerpt, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('content') !!}
            {!! Form::textarea('content',$post->content, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('published') !!}
            {!! Form::checkbox('published',$post->published, true, false) !!}
        </div>
        <div class="form-group">
            {!! Form::label('published_at') !!}
            {!! Form::input('date', 'published_at', $post->published_at, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    @endforeach
@endsection