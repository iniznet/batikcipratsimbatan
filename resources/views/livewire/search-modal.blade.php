{{-- Search Modal --}}
<div
  x-data="{ modal: false }"
  @toggle-search.window="modal = !modal"
>
    <div
      class="fixed top-0 z-20 w-full"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="transform -translate-y-full"
      x-transition:enter-end="transform translate-y-0"
      x-transition:leave="transition ease-in duration-300"
      x-transition:leave-start="transform translate-y-0"
      x-transition:leave-end="transform -translate-y-full"
      x-show="modal"
      x-cloak
    >
      <div
        class="relative z-20 bg-white"
        @click.outside="modal = false"
      >
        <div class="max-w-5xl px-4 py-6 mx-auto">
          {{-- Input form --}}
          <div class="relative flex items-center">
            <input
              wire:model.live.debounce.500ms="query"
              type="text"
              class="w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-yellow-400 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-yellow-300"
              placeholder="Cari..."
            >
            <button
              wire:click="$set('query', '')"
              type="button"
              class="absolute right-0 flex items-center justify-center w-8 h-8 mx-4 text-gray-400 transition duration-500 transform scale-110 rounded-full hover:bg-black/5 active:bg-black/10 active:scale-100">
                <x-lucide-x-circle class="w-6 h-6" />
            </button>
          </div>

          <div wire:loading class="w-full mt-4">
            <div class="flex items-center justify-center w-full gap-4">
              <svg class="w-8 h-8 text-black animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
              <p class="text-sm text-gray-500">Mencari...</p>
            </div>
          </div>

          <div wire:loading.remove>
            @if (!$query)
              {{-- Popular searches --}}
              <div class="py-6">
                <p class="text-sm text-center text-gray-500">Pencarian populer:</p>
                <div class="flex flex-wrap justify-center mt-2 space-x-2">
                  <button
                    wire:click="$set('query', 'Batik')"
                    type="button"
                    class="px-2 py-1 text-sm text-white transition duration-500 transform bg-yellow-600 rounded-full hover:scale-110 hover:bg-yellow-700 active:bg-yellow-800 active:scale-100"
                  >Batik</button>
                  <button
                    wire:click="$set('query', 'Ciprat')"
                    type="button"
                    class="px-2 py-1 text-sm text-white transition duration-500 transform bg-yellow-600 rounded-full hover:scale-110 hover:bg-yellow-700 active:bg-yellow-800 active:scale-100"
                  >Ciprat</button>
                  <button
                    wire:click="$set('query', 'Langitan')"
                    type="button"
                    class="px-2 py-1 text-sm text-white transition duration-500 transform bg-yellow-600 rounded-full hover:scale-110 hover:bg-yellow-700 active:bg-yellow-800 active:scale-100"
                  >Langitan</button>
                </div>
              </div>
            @else
              @if (!count($products))
                {{-- No results --}}
                <div class="mt-4">
                  <p class="text-sm text-center text-gray-500">Tidak ada hasil untuk "{{ $query }}".</p>
                </div>
              @else
                {{-- Results --}}
              @endif
            @endif
          </div>
        </div>
    </div>
  </div>

  {{-- backdrop blur --}}
  <div
    class="fixed inset-0 z-10 bg-black/50 backdrop-blur"
    x-transition.opacity
    x-show="modal"
    x-cloak
  ></div>
</div>
