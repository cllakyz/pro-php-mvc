@extends('static.layout')

@section('title', 'Makaleler')

@section('content')
    <h3>Makaleler</h3>
    @foreach($articles as $article)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $article->post_title }}</h5>
                <p class="card-text">{!! $article->post_short_content !!}</p>
                <a href="{{ route('articles.show', ['url' => $article->post_sef]) }}" class="btn btn-primary">Show</a>
            </div>
        </div>
    @endforeach
@endsection