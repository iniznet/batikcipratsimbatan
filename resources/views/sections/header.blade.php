<div
  x-data="navigation"
  @scroll.window="scroll"
>
  <div class="z-10 px-4 py-4 bg-[#343434] border-b-8 border-yellow-600 text-white hidden lg:block">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <div class="grid grid-cols-3 gap-4">
        <div class="text-center transition duration-1000 col-span-full hover:scale-110">
          <a href="{{ route('home') }}" class="font-title">
            <span class="block text-6xl font-semibold leading-normal">Batik Ciprat</span>
            <span class="block -mt-4 text-4xl font-light leading-none">Langitan</span>
          </a>
        </div>

        <div class="flex items-center justify-between col-span-full">
          {{-- Navigation: Home, Catalog, Blog --}}
          <nav class="hidden lg:block">
            <ul class="flex gap-12">
              <li>
                <a href="{{ route('home') }}" class="text-xl transition hover:text-yellow-600">Beranda</a>
              </li>
              <li>
                <a href="{{ route('home') }}" class="text-xl transition hover:text-yellow-600">Katalog</a>
              </li>
              <li>
                <a href="{{ route('home') }}" class="text-xl transition hover:text-yellow-600">Blog</a>
              </li>
            </ul>
          </nav>

          {{-- Search Icon - Cart Icon --}}
          <div class="flex items-center space-x-6">
            <button
              @click="$dispatch('toggle-search')"
              type="button"
              class="p-2 text-xl transition duration-500 transform rounded-full hover:scale-110 hover:bg-black/5 active:bg-black/10 active:scale-100"
            >
              <x-lucide-search class="w-6 h-6" />
            </button>
            <button
              @click="$dispatch('toggle-cart')"
              type="button"
              class="relative p-2 text-xl transition duration-500 transform rounded-full hover:scale-110 hover:bg-black/5 active:bg-black/10 active:scale-100"
            >
              <x-lucide-shopping-basket class="w-6 h-6" />
              <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs bg-yellow-600 rounded-full">0</span>
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@section('widgets')
  <div
    x-data="{ shown: false }"
    x-init="$el.classList.remove('lg:hidden')"
    class="fixed top-0 z-20 block w-full lg:hidden"
    @toggle-nav.window="shown = !shown"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-show="shown || window.innerWidth < 1024"
  >
    <div
      class="px-4 bg-[#343434] border-b-8 border-yellow-600 text-white"
    >
      <div class="w-full max-w-5xl mx-auto lg:px-4">
        <div class="flex gap-8">
          <div class="text-center transition duration-1000 hover:scale-110">
            <a href="{{ route('home') }}" class="font-title">
              <span
                class="block text-4xl font-semibold leading-normal"
              >Batik Ciprat</span>
              <span
                class="block -mt-4 text-2xl font-light leading-normal"
              >Langitan</span>
            </a>
          </div>

          <div class="flex items-center justify-between flex-grow">
            {{-- Navigation: Home, Catalog, Blog --}}
            <nav class="hidden lg:block">
              <ul class="flex gap-12">
                <li>
                  <a href="{{ route('home') }}" class="text-xl transition hover:text-yellow-600">Beranda</a>
                </li>
                <li>
                  <a href="{{ route('home') }}" class="text-xl transition hover:text-yellow-600">Katalog</a>
                </li>
                <li>
                  <a href="{{ route('home') }}" class="text-xl transition hover:text-yellow-600">Blog</a>
                </li>
              </ul>
            </nav>

            {{-- Menu Icon - Search Icon - Cart Icon --}}
            <div x-data class="flex items-center ml-auto space-x-2">
              <button
                @click="$dispatch('toggle-dropdown')"
                type="button"
                class="p-2 text-xl transition duration-500 transform rounded-full hover:scale-110 hover:bg-black/5 active:bg-black/10 active:scale-100"
              >
                <x-lucide-menu class="w-6 h-6" />
              </button>
              <button
                @click="$dispatch('toggle-search')"
                type="button"
                class="p-2 text-xl transition duration-500 transform rounded-full hover:scale-110 hover:bg-black/5 active:bg-black/10 active:scale-100"
              >
                <x-lucide-search class="w-6 h-6" />
              </button>
              <button
                @click="$dispatch('toggle-cart')"
                type="button"
                class="relative p-2 text-xl transition duration-500 transform rounded-full hover:scale-110 hover:bg-black/5 active:bg-black/10 active:scale-100"
              >
                <x-lucide-shopping-basket class="w-6 h-6" />
                <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs bg-yellow-600 rounded-full">0</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Navigation Dropdown --}}

  {{-- Search Modal --}}
  <livewire:search-modal />

  {{-- Cart List Modal --}}
  <livewire:cart-list />
@endsection
