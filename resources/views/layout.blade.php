<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>@yield('title')</title>
    @livewireStyles
</head>
<body class="bg-dark text-white">
    <header class="p-3 text-bg-dark">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><strong><a href="/" class="nav-link px-2 text-white">Главная</strong></a></li>

              @foreach ($cats as $el)

              <li><a class="nav-link px-2 text-white" href={{ route('categories.show', $el->slug) }}>{{ $el->title }}</a></li>

              @endforeach


            </ul>
            @auth
            @if(Auth::user()->isAdmin)
                <a href={{ route('editlist') }}> <button type="button" class="btn btn-sm btn-outline-info me-2">Категории</button></a>
                <a href={{ route('users.index') }}><button type="button" class="btn btn-sm btn-outline-danger me-2">Пользователи</button></a>
            @endif


            <div class="text-end">

              <a href="{{ route('logout.perform') }}" class="btn btn-sm btn-outline-light me-2">Выход</a>
            </div>
            @endauth


            @guest
            <div class="text-end">
              <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Вход</a>
              <a href="{{ route('register.perform') }}" class="btn btn-warning">Регистрация</a>
            </div>
            @endguest

            </div>
          </div>
        </div>
        <hr>
      </header>
      <div class="b-example-divider"></div>

      <div class="container">

        @yield('content')

    </div>
    @livewireScripts
</body>
</html>
