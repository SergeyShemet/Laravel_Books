@extends('layout')

@section('title')Главная страница@endsection

@section('content')

<div class="bg-dark  p-5 rounded">
    @auth
    <p class="lead">{{ Auth::user()->name }}, Вы залогинены. Поздравляем.</p>
    @endauth
</div>
<br>
<p>Дорогие друзья!</p>
<p>Спасибо, что посетили эту страницу.</p>
<p>Если вы залогинены, то можете просматривать книги и оставлять комментарии как обычный пользователь.</p>
<p>Если Администратор включил вашей учётной записи опцию "сотрудник", то можете редактировать и добавлять книги и категории.</p>
<p>Вы можете войти как Администратор, используя admin@domain.com / password</p>
<p>Или просто выбрать нужную категорию книг:</p>
<ul>

    @foreach ($cats as $el)

    <li><a class="nav-link px-2 text-white" href={{ route('categories.show', $el->slug) }}>{{ $el->title }}</a></li>

    @endforeach

</ul>

@endsection
