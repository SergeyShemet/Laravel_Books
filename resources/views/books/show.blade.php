@extends('layout')

@section('title'){{ $book->author }} - {{ $book->title }}@endsection

@section('content')


<h3>Книга: {{ $book->author }} - {{ $book->title }}</h3>
<br>

<div class="album p-1 bg-light text-dark p-5 mb-5">
    <div class="container">
        <div class="text-center"><h1>{{ $book->title }}</h1><br>Автор: {{ $book->author }}</div>
        <br>
        <img class="card-img-top  rounded mx-auto d-block my-3" style="width: 400px" src="{{ ($book->cover != '') ? asset('storage/covers/'.$book->cover) : asset('storage/covers/no.png') }}">
        <br>
        <p><strong>Рейтинг: </strong>{{ $book->rating }}%</p>
        <p><strong>Описание: </strong>{{ $book->description }}</p>
        <hr>
        <strong><h3><div class="text-center">Комментарии:</h3> </strong></div>
    <br>
            <div class="text-center"><h4>{{ count($comments) == 0 ? 'Пусто' : '' }}</h4></div><br>

            @foreach ($comments as $el)
            <small>{{ $el->created_at }}</small> --- <strong> {{ $el->users->name }} </strong>
                <span class="text-secondary"> {{ $el->users->isAdmin != 0 ? '(сотрудник)' : '' }}  </span>
                @if(Auth::check() && Auth::user()->isAdmin)


                <form id='del-{{ $el->id }}' style="display: inline;" method="POST" action="{{ route('comment.destroy', $el->id) }}"  >
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <span class="form-group"><input type="submit" class="btn btn-sm btn-outline-danger" style="margin-left: 30px" value="Удалить"></span></form>

                @endif
                <br>
                <p>{{ $el->comment }}</p>
                <br><hr>
            @endforeach



            @guest
            <div class="text-center">
            Войдите, чтобы оставить комментарий!
            </div>
            @endguest

            @auth

            <div class="text-center">Оставьте свой комментарий:</div>
            <p>Имя пользователя: {{ Auth::user()->name }}</p>


            <form action="{{ route('comment.custom.store', ['book_id'=>$book->id, 'user_id'=>Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
            <textarea name="text" class="form-control" placeholder="Введите текст комментария"></textarea><br>
                @csrf
                <button type="submit" class="btn btn-success">Отправить комментарий</button></form>
            @endauth
            <br>
</div>

@endsection
