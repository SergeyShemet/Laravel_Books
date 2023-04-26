@extends('layout')

@section('title')Редактирование книги@endsection

@section('content')



<div class="bg-dark  p-5 rounded">

@if(Auth::check() && Auth::user()->isAdmin)
    <h3>Редактирование книги</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->slug)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <input type="text" name="author" id="author" placeholder="Введите автора книги"  value="{{ $book->author }}" class="form-control"><br>
        <input type="text" name="title" id="title" placeholder="Введите название книги"  value="{{ $book->title }}" class="form-control"><br>
        <input type="text" name="description" id="description" placeholder="Введите описание книги"  value="{{ $book->description }}" class="form-control"><br>
        <div class="form-group">
            <label for="image">Картинка обложки (выберите файл, если хотите изменить её)</label>
            <br>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <br>
        <button type="submit" class="btn btn-success">Сохранить изменения</button></form>





    @endif


    @endsection
