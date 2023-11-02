<div
  x-data="{ input: @entangle($attributes->wire('model')) }"
  class="relative flex items-center"
>
  <input
    x-model="input"
    {{ $attributes->twMerge(['class' => 'w-full rounded-full border border-[#e6e9f0] pl-4 pr-8 py-2 focus:outline-none focus:ring-2 focus:ring-[#006ce2]', 'type' => 'text']) }}
    placeholder="{{ $slot }}"
  >

  @if ($attributes->has('searchIcon'))
    <div class="absolute left-0 px-4">
      <x-lucide
        class="w-5 h-5"
      >
        <x-lucide-search />
      </x-lucide>
    </div>
  @endif

  <template x-if="input.length">
    <div class="absolute right-0 px-4">
      <x-lucide
        @click.prevent="input = ''"
        class="w-5 h-5"
      >
        <x-lucide-x />
      </x-lucide>
    </div>
  </template>
</div>
