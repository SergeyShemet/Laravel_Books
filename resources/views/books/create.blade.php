@extends('layout')

@section('title')Создание книги@endsection

@section('content')



<div class="bg-dark  p-5 rounded">

    @if(Auth::check() && Auth::user()->isAdmin)
    <h3>Создание книги. Категория - {{ $curcat->title }}</h3>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" style="display: none" name="slug" id="cat" value="{{ $curcat->slug }}" class="form-control"><br>
        <input type="text" name="author" id="title" placeholder="Введите автора книги"  value="{{ old('author') }}" class="form-control"><br>
        <input type="text" name="title" id="title" placeholder="Введите название книги"  value="{{ old('title') }}" class="form-control"><br>
        <input type="text" name="description" id="title" placeholder="Введите описание книги"  value="{{ old('description') }}" class="form-control"><br>
        <div class="form-group">
            <label for="image">Картинка обложки</label>
            <br>
            <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
        </div>
        <br>
        <button type="submit" class="btn btn-success">Создать</button></form>





    @endif


    @endsection
