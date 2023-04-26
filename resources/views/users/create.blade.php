@extends('layout')

@section('title')Регистрация сотрудника@endsection

@section('content')

<div class="bg-dark  p-5 rounded">

<br>

@if(Auth::check() && Auth::user()->isAdmin)
<h2>Регистрация сотрудника</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="name" placeholder="Введите имя"  value="{{ old('name') }}" class="form-control"><br>
    <input type="username" name="username" id="username" placeholder="Введите логин"  value="{{ old('username') }}" class="form-control"><br>
    <input type="email" name="email" id="email" placeholder="Введите email"  value="{{ old('email') }}" class="form-control"><br>
    <input type="password" name="password" id="password" placeholder="Пароль"  value="{{ old('password') }}" class="form-control"><br>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Подтверждение пароля"  value="{{ old('password_confirmation') }}" class="form-control"><br>
    <br>
    <button type="submit" class="btn btn-success">Зарегистрировать</button></form>

@endif


@endsection
