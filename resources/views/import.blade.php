@extends('layout')

@section('title')Главная страница@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">

        <strong>{{ $message }}</strong>
</div>
@endif
<br>
<br>
<br>

Импорт Excel-файла

<form action="{{ route('importupdate') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label for="image">Выберите XLSX-файл </label>
        <br>
        <input type="file" class="form-control-file" id="file" name="file">
    </div>
    <br>
    <button type="submit" class="btn btn-success">ИМПОРТ</button></form>

@endsection
