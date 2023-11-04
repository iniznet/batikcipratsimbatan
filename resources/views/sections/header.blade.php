{{-- Container --}}
<header
  x-data="{ fixed: false }"
  x-init="fixed = (window.pageYOffset > 10) ? true : false"
  @scroll.window="fixed = (window.pageYOffset > 10) ? true : false"
  @search.window="(window.pageYOffset < 10) ? fixed = !fixed : fixed = fixed"
  class="fixed top-0 left-0 z-20 w-full transition duration-300"
>
  {{-- Header Bar --}}
  <div class="relative bg-white border-b border-b-[#e6e9f0] z-10 md:bg-transparent md:border-none">
    {{-- Header Bar Background --}}
    <div
      :class="fixed && 'h-full'"
      class="absolute left-0 top-0 h-0 bg-white shadow-[0_6px_33px_rgba(213,213,213,.25)] w-full transition-[height] duration-300 delay-300"
    ></div>

    {{-- Header Bar Container --}}
    <div class="relative w-full px-6 py-2 2xl:py-8 mx-auto lg:px-8 2xl:px-24 md:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full">
      {{-- Box --}}
      <div class="flex items-center justify-between">
        {{-- Logo --}}
        <div
          x-data
          x-class-init.delay.1000.hold.2000="'scale-110'"
          class="text-center transition duration-1000 font-title place-self-start hover:scale-110"
        >
          <a href="/" wire:navigate.hover>
            @if ($siteLogo)
              <img src="{{ $siteLogo?->url }}" class="h-16" alt="">
            @else
              <span class="block text-3xl font-semibold leading-normal lg:text-4xl">{{ $siteTitles[0] }}</span>
              <span class="block -mt-4 text-2xl font-light leading-normal">{{ $siteTitles[1] }}</span>
            @endif
          </a>
        </div>

        {{-- Navigation Menu --}}
        <nav class="hidden px-[2vw] flex-grow lg:block xl:px-[3vw] 2xl:px-[4vw]">
          <ul class="flex font-medium justify-evenly 2xl:text-xl">
            @foreach ($headerMenu->items as $item)
              <li class="transition hover:text-[#006ce2]">
                <a href="{{ $item['data']['url'] ?? '#' }}" wire:navigate.hover>{{ $item['label'] }}</a>
              </li>
            @endforeach
          </ul>
        </nav>

        {{-- Buttons --}}
        <div class="flex items-center gap-4">
          <x-button
            :color="'transparent'"
            :shape="'circle'"
            :size="'md'"
            @click.prevent="$dispatch('search')"
          >
            <x-lucide class="p-1">
              <x-lucide-search class="w-5 h-5" />
            </x-lucide>
          </x-button>
          <x-button :color="'secondary'" :shape="'circle'" :class="'lg:hidden'">
            <x-lucide>
              <x-lucide-menu class="w-6 h-6" />
            </x-lucide>
          </x-button>
        </div>
      </div>
    </div>
  </div>

  {{-- Search Modal --}}
  <livewire:search-modal />

</header>
