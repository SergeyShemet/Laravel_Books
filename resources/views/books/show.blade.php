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
        <strong><h3><div class="text-center">Комментарии:</h3> </strong>
    </div>
    <br>
    @auth
        @livewire('comments', [$book->id, Auth::user()->id])
    @endauth
    @guest
        @livewire('comments', [$book->id, null])
    @endguest

</div>
@endsection
