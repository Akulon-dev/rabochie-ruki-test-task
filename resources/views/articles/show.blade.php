@extends(' layouts.app')

@section('title', $article->title)

@section('content')
    <h1 class="mb-4">{{ $article->title }}</h1>
    @if($article->image)
        <img src="{{ $article->image }}" alt="Изображение статьи" class="img-fluid ">
    @endif
    <p>{{ $article->body }}</p>
    <p>Теги: {{ implode(', ', $article->tags->pluck('name')->toArray()) }}</p>
    <p>Лайки: <span id="like-count">{{ $article->likes }}</span></p>
    <p>Просмотры: <span id="view-count">{{ $article->views }}</span></p>

    <button class="btn btn-primary like-button" data-id="{{ $article->id }}">👍</button>
    <h2 class="mt-4">Комментарии</h2>
    <form id="comment-form" data-article-id="{{ $article->id }}" class="mb-4">
        <div class="form-group">
            <input type="text" id="subject" class="form-control" placeholder="Тема сообщения" required>
        </div>
        <div class="form-group">
            <textarea id="body" class="form-control" placeholder="Текст сообщения" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>

    <div id="response-message" class="alert alert-success d-none" role="alert">
        Ваше сообщение успешно отправлено.
    </div>
    <div id="comments">
        @foreach($article->comments as $comment)
            <div class="comment mb-3">
                <h4>{{ $comment->subject }}</h4>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
    </div>

    <script>
        $(document).ready(function () {
            const articleId = {{ $article->id }};
            const views = {{ $article->views }};


            setTimeout(function () {
                // Отправляем AJAX-запрос для увеличения счетчика просмотров
                $.ajax({
                    url: `/api/articles/${articleId}/view`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        viewCount: views
                    },
                    success: function (data) {
                        console.log('Количество просмотров:', data.views);
                        // Обновите отображение количества просмотров на странице
                        $('#view-count').text(data.views);
                    },
                    error: function (xhr, status, error) {
                        console.error('Ошибка:', error);
                    }
                });
            }, 5000); // 5000 миллисекунд = 5 секунд

            $('#comment-form').submit(function (event) {
                event.preventDefault(); // Предотвращаем стандартное поведение формы

                const articleId = $(this).data('article-id');
                const subject = $('#subject').val();
                const body = $('#body').val();

                $.ajax({
                    url: `/api/articles/${articleId}/comments`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        subject: subject,
                        body: body
                    },
                    success: function () {
                        // Скрываем форму и показываем сообщение об успешной отправке
                        $('#comment-form').hide();
                        $('#response-message').removeClass('d-none').text('Ваше сообщение успешно отправлено.');
                        const newComment = `<div class="comment mb-3"><h4>${subject}</h4><p>${body}</p></div>`;
                        $('#comments').append(newComment);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
