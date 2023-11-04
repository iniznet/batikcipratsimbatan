<div
  x-data="{ show: false }"
  @search.window="show = !show"
  @click.outside="show = false"
  class="absolute left-0 w-full py-8 bg-white shadow-lg md:pb-12"
  x-transition:enter="transition-[top] ease-out duration-300"
  x-transition:enter-start="-top-full"
  x-transition:enter-end="top-full"
  x-transition:leave="transition-[top] ease-in duration-300"
  x-transition:leave-start="top-full"
  x-transition:leave-end="-top-full"
  x-show="show"
  x-cloak
>
  {{-- Container --}}
  <div class="relative w-full px-6 py-2 2xl:py-8 mx-auto lg:px-8 2xl:px-24 md:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full">
    {{-- Search line --}}
    <div class="relative space-y-4">
      <form class="flex items-center">
        {{-- Input --}}
        <input
          wire:model.live.debounce.500ms="searchQuery"
          type="text"
          class="w-full px-10 py-4 border border-[#e6e9f0] rounded-full focus:outline-none focus:ring-2 focus:ring-[#006ce2]"
          placeholder="Cari sesuatu..."
        />

        {{-- Search icon --}}
        <div class="absolute left-0 px-4">
          <x-lucide class="w-5 h-5">
            <x-lucide-search />
          </x-lucide>
        </div>

        {{-- Clear icon --}}
        <div class="absolute right-0 px-4">
          <x-lucide class="w-5 h-5">
            <x-lucide-x />
          </x-lucide>
        </div>
      </form>

      {{-- Search results --}}
      <div class="bg-[#f5f7fd] rounded-3xl px-2">
        {{-- Livewire loading --}}
        <div wire:loading class="w-full py-10">
          <div class="flex items-center justify-center">
            <x-loading />
          </div>
        </div>

        {{-- Livewire results --}}
        <div wire:loading.remove>
          @if ($results->isEmpty() && $searchQuery)
            <div class="flex justify-center py-10">
              <h5 class="text-lg font-semibold">{{ __('Tidak ada yang ditemukan') }}</h5>
            </div>
          @else
            @if ($results->isNotEmpty())
              <ul class="py-4 overflow-auto max-h-48">
                @foreach ($results as $item)
                  <li>
                    <a href="{{ $item->url }}" class="block px-8 py-4 text-lg transition rounded-3xl hover:bg-white" wire:navigate.hover>{!! $item->title !!}</a>
                  </li>
                @endforeach
              </ul>
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
