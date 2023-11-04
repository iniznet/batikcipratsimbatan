<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('settings.site_title') }} - @yield('description', config('settings.tagline'))</title>
  @if ($siteLogo)
    <link rel="shortcut icon" type="image/x-icon" href="{{ $siteLogo?->url }}">
  @endif
  @vite('resources/css/app.css')
  @livewireStyles
  @vite('resources/js/app.js')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Carlito:wght@400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Moulpali:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
  <div class="overflow-hidden pt-20 md:pt-24 2xl:pt-32 text-[#222]">
    @include('sections.header')

    <main>
      @hasSection('hero')
        @yield('hero')
      @endif

      @yield('content')
    </main>

    @include('sections.footer')
  </div>

  @yield('widgets')
  @stack('scripts')
  @livewireScriptConfig
</body>

</html>
