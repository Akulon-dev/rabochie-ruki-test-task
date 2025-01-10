@extends('layouts.app')

@section('title', 'Каталог статей')

@section('content')
    <h1 class="mb-4">Каталог статей</h1>
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        @if($article->image)
                            <img src="{{ $article->image }}" alt="Изображение статьи" class="img-fluid">
                        @endif
                        <h5 class="card-title"><a
                                href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h5>
                        <p class="card-text">{{ Str::limit($article->body, 100) }}</p>
                        <p class="card-text"><small
                                class="text-muted">Теги: {{ implode(', ', $article->tags->pluck('name')->toArray()) }}</small>
                        </p>
                        <p class="card-text">Лайки: <span
                                id="like-count-{{ $article->id }}">{{ $article->likes }}</span></p>
                        <p>Просмотры: <span >{{ $article->views }}</span></p>
                        <button class="btn btn-primary like-button" data-id="{{ $article->id }}" data-likes="{{ $article->likes }}">👍</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($isPaging)
        <div class="d-flex justify-content-center">
            {{ $articles->links('vendor.pagination.bootstrap-4') }} <!-- Пейджинация -->
        </div>
    @endif
@endsection
