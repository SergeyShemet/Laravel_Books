@extends('layout')

@section('title')Редактирование пользователя@endsection

@section('content')
<h2>Редактирование пользователя</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('users.update', $user->id) }}" method="POST" >
    @method('PUT')
    @csrf

    <input type="checkbox" name="isAdmin" {{ ($user->isAdmin) ? 'checked' : '' }}><label>Сотрудник</label>
    <input  name="name"  value="{{ $user->name }}" class="form-control"><br>
    <input  name="username"  value="{{ $user->username }}" class="form-control"><br>
    <input  name="email"  value="{{ $user->email }}" class="form-control"><br>

    <br>
    <button type="submit" class="btn btn-success">Сохранить изменения</button>
</form>
@endsection
