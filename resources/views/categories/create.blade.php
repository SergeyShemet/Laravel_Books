@extends('layout')

@section('title')Редактор категорий@endsection

@section('content')

<div class="bg-dark  p-5 rounded">

<br>

@if(Auth::check() && Auth::user()->isAdmin)
<h2>Создание категории</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="title" name="title" id="title" placeholder="Введите название категории"  value="{{ old('title') }}" class="form-control"><br>
    <br>
    <button type="submit" class="btn btn-success">Создать</button></form>




@endif


@endsection
