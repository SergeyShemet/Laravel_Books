@extends('layout')

@section('title')Редактор категорий@endsection

@section('content')

<div class="bg-dark  p-5 rounded">

<br>

@if(Auth::check() && Auth::user()->isAdmin)
<h2>Редактирование категории</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.update', $category) }}" method="POST" >
    @method('PUT')
    @csrf
    <input type="title" name="title" id="title" value="{{ $category->title }}" class="form-control"><br>
    <br>
    <button type="submit" class="btn btn-success">Сохранить изменения</button></form>
@endif
@endsection
