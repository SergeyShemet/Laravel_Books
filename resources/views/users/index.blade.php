@extends('layout')

@section('title')Список пользователей@endsection

@section('content')

<div class="bg-dark  p-5 rounded">


@if(Auth::check() && Auth::user()->isAdmin)
<a href={{ route('users.create') }}><button type="submit" class="btn btn-primary">Зарегистрировать нового сотрудника</button></a>
    <br>
    <br>
    <table class="col-12 col-lg-auto">
        <tr><td><strong>Имя</td><td><strong>Логин</td><td><strong>Email</strong></td><td><strong>Роль</td><td><strong>Управление</td></tr></strong>
        @foreach ($users as $el)


            <tr>
                <td class="px-2 text-white" style="width: 200px">{{ $el->name }}</td><td class="px-2 text-white" style="width: 100px">{{ $el->username }}</td>
                <td class="px-2 text-white">{{ $el->email }}</td>
                <td style="width: 200px">{{ ($el->isAdmin) ? 'сотрудник' : 'пользователь'}}</td>
                <td><a href="{{ route('users.edit', $el->id) }}"><button type="button" class="btn btn-sm btn-outline-info">Ред.</button></a>
                @if ($el->isAdmin)
                <a href="{{ route('makeU', $el->id) }}"><button type="submit" class="btn btn-secondary">Сделать пользователем</button></a>
                @else
                <a href="{{ route('makeE', $el->id) }}"><button type="submit" class="btn btn-success">Сделать сотрудником</button></a>
                @endif
                </td><td>
                <form id='del-{{ $el->id }}' style="display: inline; width:300px;" method="POST" action="{{ route('users.destroy', $el->id) }}"  >
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <span class="form-group"><input type="submit" class="btn btn-sm btn-outline-danger" value="Удалить"></span></form>
            </td></tr></span>

        @endforeach
    </table>

    <br>


@endif

@guest
    ВЫ НЕ ДОЛЖНЫ БЫТЬ ЗДЕСЬ!
@endguest

@endsection
