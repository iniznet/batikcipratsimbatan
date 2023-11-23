@if (!isset($reverse) || !$reverse)
  {{-- Card --}}
  <div class="grid gap-8 p-8 shadow-lg rounded-tl-3xl rounded-br-3xl {{ isset($background) ? $background : 'bg-white' }}">
    {{-- Image --}}
    <a href="{{ route('blog.detail', $post->slug) }}" wire:navigate.hover>
      <x-image
        :source="$post->cover?->url"
        class="lg:!aspect-h-[1]"
      />
    </a>

    {{-- Content --}}
    <div>
      <a href="{{ route('blog.detail', $post->slug) }}" wire:navigate.hover>
        <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">{!! $post->title !!}</h5>
      </a>
    </div>

    <x-button
      :type="'link'"
      :color="''"
      :ring="false"
      :size="'lg'"
      :effects="['text']"
      href="{{ route('blog.detail', $post->slug) }}"
      class="!p-0 order-3 md:justify-start"
      wire:navigate.hover
    >
      <span class="uppercase">{{ __('Baca Selengkapnya') }}</span>
      <x-lucide
        :color="'primary'"
        :size="'lg'"
        :shape="'circle'"
        :effects="['background', 'scale-in']"
      >
        <x-lucide-arrow-up-right :class="'w-6 h-6 text-white'" />
      </x-lucide>
    </x-button>
  </div>
@else
  {{-- Card --}}
  <div class="grid gap-8 p-8 shadow-lg rounded-tl-3xl rounded-br-3xl {{ isset($background) ? $background : 'bg-white' }}">
    {{-- Image --}}
    <div class="order-2">
      <a href="{{ route('blog.detail', $post->slug) }}" wire:navigate.hover>
        <x-image
          :source="$post->cover?->url"
          class="lg:!aspect-h-[1]"
        />
      </a>
    </div>

    {{-- Content --}}
    <div>
      <a href="{{ route('blog.detail', $post->slug) }}" wire:navigate.hover>
        <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">{!! $post->title !!}</h5>
      </a>
    </div>

    <x-button
      :type="'link'"
      :color="''"
      :ring="false"
      :size="'lg'"
      :effects="['text']"
      href="{{ route('blog.detail', $post->slug) }}"
      class="!p-0 order-3 md:justify-start"
      wire:navigate.hover
    >
      <span class="uppercase">{{ __('Baca Selengkapnya') }}</span>
      <x-lucide
        :color="'primary'"
        :size="'lg'"
        :shape="'circle'"
        :effects="['background', 'scale-in']"
      >
        <x-lucide-arrow-up-right :class="'w-6 h-6 text-white'" />
      </x-lucide>
    </x-button>
  </div>
@endif
