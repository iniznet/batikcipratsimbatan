<footer class="relative bg-[#f5f7fd] pt-16 pb-9">
  {{-- Container --}}
  <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
    {{-- Content --}}
    <div class="grid-cols-7 space-y-4 lg:grid">
      {{-- Left --}}
      <div class="relative col-span-3 pr-8 space-y-4">
        {{-- Logo --}}
        <div
          x-data
          x-class-init.delay.1000.hold.2000="'scale-110'"
          class="inline-flex justify-start transition duration-1000 font-title place-self-start hover:scale-110"
          >
          <a href="/" class="text-center" wire:navigate.hover>
            @if ($siteLogo)
              <img src="{{ $siteLogo?->url }}" class="h-16" alt="">
            @else
              <span class="block text-3xl font-semibold leading-normal lg:text-4xl">{{ $siteTitles[0] }}</span>
              <span class="block -mt-4 text-2xl font-light leading-normal">{{ $siteTitles[1] }}</span>
            @endif
          </a>
        </div>

        {{-- Tagline --}}
        <div class="text-xl">
          <p>{{ config('settings.site_title') }} — {{ config('settings.description') }}</p>
        </div>
      </div>

      {{-- Right --}}
      <div class="col-start-4 col-end-8 space-y-4">
        {{-- Footer Navigation --}}
        <div class="grid pb-6 gap-y-4 md:grid-cols-2">
          {{-- Left --}}
          <div class="text-xl">
            <div class="mb-4 font-semibold">{{ __('Navigasi') }}</div>
            <ul class="flex flex-col space-y-2">
              @foreach ($footerMenu1->items as $item)
                <li>
                  <a href="{{ $item['data']['url'] ?? '#' }}" wire:navigate.hover>{{ $item['label'] }}</a>
                </li>
              @endforeach
            </ul>
          </div>

          {{-- Right --}}
          <div class="text-xl">
            <div class="mb-4 font-semibold">{{ __('Lainnya') }}</div>
            <ul class="flex flex-col space-y-2">
              @foreach ($footerMenu2->items as $item)
                <li>
                  <a href="{{ $item['data']['url'] ?? '#' }}" wire:navigate.hover>{{ $item['label'] }}</a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        {{-- Copyright & Credit --}}
        <div class="grid md:grid-cols-2 pt-6 border-t border-t-[#a5b5e6]">
          {{-- Left --}}
          <div>@ {{ now()->year . ' ' . config('settings.site_title') }}.<br> {{ __('All Rights Reserved.') }}</div>

          {{-- Right --}}
          <div>
            {!! sprintf(__('Dikembangkan oleh %s'), '<a href="https://github.com/iniznet" target="_blank" rel="noopener noreferrer">' . __('Tim PPK Deptics 2023') . '</a>') !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

@push('scripts')
  {{-- Load FancyBox --}}
  <div
    x-ignore
    ax-load
    x-data="iframe"
    x-init="$el.remove()"
  ></div>

  @if (config("settings.google_analytics_id"))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.google_analytics_id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ config("settings.google_analytics_id") }}');
    </script>
  @endif
@endpush
