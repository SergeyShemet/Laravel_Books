@extends('layout')

@section('title')Редактор категорий@endsection

@section('content')

<div class="bg-dark  p-5 rounded">

<br>

@if(Auth::check() && Auth::user()->isAdmin)
    <table class="col-12 col-lg-auto">
        @foreach ($cats as $el)

            <tr><td class="nav-link px-2 text-white">{{ $el->title }}</td>
                <td><a href="{{ route('categories.edit', $el->slug) }}"><button type="button" class="btn btn-sm btn-outline-info">Ред.</button></a>
                <form id='del-{{ $el->id }}' style="display: inline; width:300px;" method="POST" action="{{ route('categories.destroy', $el->slug) }}"  >
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <span class="form-group"><input type="submit" class="btn btn-sm btn-outline-danger" value="Удалить"></span></form>
            </td></tr></span>

        @endforeach
    </table>

    <br>
<a href={{ route('categories.create') }}><button type="submit" class="btn btn-success">Создать новую категорию</button></a>

@endif
@endsection
