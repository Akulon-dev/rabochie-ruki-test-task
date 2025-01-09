@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <h1 class="mb-4">Последние статьи</h1>
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></h5>
                        <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                        <p class="card-text"><small class="text-muted">Теги: {{ implode(', ', $article->tags->pluck('name')->toArray()) }}</small></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
