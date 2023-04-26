@extends('layout')

@section('title'){{ $cattitle }}@endsection

@section('content')


<h3>Категория: {{ $cattitle }}</h3>


<div class="row-fluid">

<div class="album py-5 bg-light text-dark ">

    <div class="container">
        @if(Auth::check() && Auth::user()->isAdmin)
        <a href={{ route('bookcreate', $catid) }}> <button type="button" class="btn btn-lg btn-primary">Добавить новую книгу в категорию</button><br></a>
      @endif
      <div class="row">

        @if (count($booklist) > 0)
            @foreach ($booklist as $el)

                <div class="col-md-4" >
                <div class="card mb-4 shadow-sm ">
                    <a href={{ route('books.show', $el->slug) }}><img class="card-img-top  rounded mx-auto d-block my-3" style="width: 200px;" src="{{ ($el->cover != '') ? asset('storage/covers/'.$el->cover) : asset('storage/covers/no.png') }}"></a>
                    <div class="card-body">
                    <p class="card-text">{{ $el->author }}</p>
                    <p><strong>{{ $el->title }}</strong></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        <a href={{ route('books.show', $el->slug) }}><button type="button" class="btn btn-sm btn-warning">Подробнее</button></a>
                        @if(Auth::check() && Auth::user()->isAdmin)
                             <a href={{ route('books.edit', $el->slug) }}><button type="button" class="btn btn-sm btn-info">Ред.</button></a>
                            <form id='del-{{ $el->id }}' style="display: inline;" method="POST" action="{{ route('books.destroy', $el->slug) }}"  >
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <span class="form-group"><input type="submit" class="btn btn-sm btn-danger" value="Удалить"></span></form>

                        @endif
                        </div>
                        <small class="text-muted">Рейтинг: {{ $el->rating }}%</small>
                    </div>
                    </div>
                </div>
                </div>
            @endforeach
            <br><div class="text-center">{{ $booklist->links() }}</div>

                    @if(Auth::check() && Auth::user()->isAdmin)
                    <a href={{ route('bookcreate', $catid) }}> <button type="button" class="btn btn-lg btn-primary">Добавить новую книгу в категорию</button><br></a>
                    @endif
         @else
                <p>Книги данной категории отсутствуют</p>
         @endif
      </div>
    </div>
  </div>


  @endsection
