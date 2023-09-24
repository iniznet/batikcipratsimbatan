<div
  x-data="{ shown: false }"
  @toggle-cart.window="shown = !shown"
>
  <div
    class="fixed top-0 right-0 z-20 h-full bg-white"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="transform translate-x-full"
    x-transition:enter-end="transform translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="transform translate-x-0"
    x-transition:leave-end="transform translate-x-full"
    @click.outside="shown = false"
    x-show="shown"
    x-cloak
  >
    <div class="relative px-8 py-4">
      {{-- Title --}}
      <div class="flex items-center justify-center py-4 mb-8">
        <h2 class="text-4xl font-semibold">Keranjang</h2>
        <button
          @click="shown = false"
          type="button"
          class="absolute flex items-center justify-center w-12 h-12 bg-white border border-gray-200 rounded-full -left-6 focus:outline-none"
        >
          <x-lucide-chevron-right class="w-6 h-6" />
        </button>
      </div>

      {{-- Cart items --}}
      <div class="gap-4 lg:px-8 lg:py-8">
        {{-- Not found text & button --}}
        <div class="space-y-4 text-center">
          <p class="text-lg text-center text-gray-500">Tidak ada produk di keranjang.</p>
          <button
            type="button"
            class="px-4 py-2 text-sm font-semibold tracking-wider text-white uppercase transition-colors duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 active:bg-yellow-800 active:scale-100"
            @click="shown = false"
          >Lihat Katalog</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Backdrop --}}
  <div
    x-show="shown"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak
    class="fixed inset-0 z-10 bg-black/50"
  ></div>
</div>
