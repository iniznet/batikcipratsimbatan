<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('settings.site_title') }} - @yield('description', config('settings.tagline'))</title>
  @vite('resources/css/app.css')
  @livewireStyles
  @vite('resources/js/app.js')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Raleway:wght@400;600&display=swap" rel="stylesheet">
</head>

<body x-data="{ mobileNav: false }">
  <div id="app" class="relative min-h-screen">
    @include('sections.header')

    <main class="mt-20 text-gray-800 lg:m-0">
      @hasSection('hero')
        @yield('hero')
      @endif

      @yield('content')
    </main>

    @include('sections.footer')
  </div>

  @yield('widgets')
  @livewireScriptConfig
</body>

</html>
