<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('settings.site_title') }} - @yield('description', config('settings.tagline'))</title>
  @vite('resources/css/app.css')
</head>

<body x-data="{ mobileNav: false }">
  <div id="app" class="min-h-screen">
    @include('sections.header')

    <main>
      @hasSection('hero')
        @yield('hero')
      @endif

      <div class="w-full max-w-5xl mx-auto">
        @yield('content')
      </div>
    </main>

    @include('sections.footer')
  </div>

  @vite('resources/js/app.js')
</body>

</html>
