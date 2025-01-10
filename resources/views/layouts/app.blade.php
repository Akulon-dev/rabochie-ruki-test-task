<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">Блог</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">Главная страница</a>
            </li>
            <li class="nav-item {{ request()->is('articles*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('articles.catalog') }}">Каталог статей</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script>
    $(document).ready(function () {

        $('.like-button').click(function () {
            const articleId = $(this).data('id');
            let curLikes = $(this).data('likes');
            $.ajax({
                url: `/api/articles/${articleId}/like`,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Если требуется CSRF-токен
                },
                data: {
                    likeCount: curLikes
                },
                success: function (data) {
                    @if(request()->is('articles') or request()->is('/'))
                    $('#like-count-' + articleId).text(data.likes);
                    $('.like-button[data-id="' + articleId + '"]').data('likes', data.likes);
                    @else
                    $('#like-count').text(data.likes);
                    $('.like-button').data('likes', data.likes);
                    @endif

                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
</body>
</html>
