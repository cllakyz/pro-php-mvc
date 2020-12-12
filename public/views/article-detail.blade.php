@extends('static.layout')

@section('title', 'Makaleler - '. $article->post_title)

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $article->post_title }}</h5>
            <p class="card-text">{!! $article->post_content !!}</p>
        </div>
    </div>
@endsection