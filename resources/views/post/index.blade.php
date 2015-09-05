@extends('app')

@section('content')
    @foreach($posts as $post)
        <article>
            <h2>{!! $post->title!!}</h2>
            <p>
                {!!$post->excerpt!!}
            </p>
            <p>Published: {{$post->published_at}}</p>
        </article>
    @endforeach
@stop