<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

  <title>FindAGrave</title>

  <link rel="shortcut icon" href="{{ asset('/favicon.png') }}" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet" />

  @vite('resources/scss/app.scss')
  @vite('resources/ts/app.ts')

  @yield('head')
</head>
<body @class([
  'page',
  sprintf('page--%s', $route()->getName())
])>
  <x-widgets.header></x-widgets.header>
  <div class="content">
      @yield('content')
  </div>
  <x-widgets.footer></x-widgets.footer>

  <x-shared.dialog.browse-locations></x-shared.dialog.browse-locations>
</body>
</html>
