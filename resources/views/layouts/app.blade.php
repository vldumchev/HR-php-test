<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <title>Тестовое задание</title>
</head>

<body>
  @yield('navigation')
  @yield('content')

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>