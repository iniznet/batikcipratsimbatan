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

        {{-- Social Icons --}}
        <div class="flex justify-between -mx-3 font-heading lg:justify-start lg:gap-4">
          @foreach ($socials as $social)
            <x-button
              :type="'link'"
              :color="'tertiary'"
              :effects="['scale-in']"
              :ring="false"
              :shape="'circle'"
              href="{{ $social['link'] }}"
              class="px-3 py-3 md:py-2"
              target="_blank"
            >
              <x-lucide
                :effects="['opacity']"
              >
                <x-dynamic-component :component="'simpleicon-' . strtolower($social['name'])" class="w-10 h-10 text-zinc-500 hover:text-zinc-900" />
              </x-lucide>
            </x-button>
          @endforeach
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
              @foreach ($footerMenu1?->items ?: [] as $item)
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
              @foreach ($footerMenu2?->items ?: [] as $item)
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
          <div>
            {{-- Copyright --}}
            <div>@ {{ now()->year . ' ' . config('settings.site_title') }}.<br> {{ __('All Rights Reserved.') }}</div>
          </div>

          {{-- Right --}}
          <div>
            {{-- Credit --}}
            <div>
              {!! sprintf(__('Dikembangkan oleh %s'), '<a href="https://github.com/iniznet" target="_blank" rel="noopener noreferrer">' . __('Tim PPK Deptics 2023') . '</a>') !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

@push('widgets')
  {{-- WhatsApp Button --}}
  <div
    class="fixed bottom-0 right-0 z-10 p-4"
    data-scroll
    data-scroll-sticky
  >
    <x-button
      type="link"
      color=""
      shape="circle"
      size="md"
      effects="scale-in"
      @click.prevent="open = false"
      class="bg-[#25D366] hover:bg-[#075E54]"
      href="https://api.whatsapp.com/send?phone={{ $primaryPhone }}&text=Halo%20{{ config('settings.site_title') }}%2C%0A%0ASaya%20ingin%20bertanya%20tentang%20..."
      target="_blank"
    >
      <x-lucide class="p-1">
        <x-dynamic-component :component="'simpleicon-whatsapp'" class="w-7 h-7" style="color: #fff;" />
      </x-lucide>
    </x-button>
  </div>
@endpush

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
