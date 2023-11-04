@if ($source || (!$source && $fallback))
  <div {{ $attributes->twMerge(['class' => 'overflow-hidden rounded-tl-[40px] rounded-br-[40px]']) }}>
    <img src="{{ $source ?: Vite::asset('resources/img/404.png') }}" class="object-cover object-center w-full h-full">
  </div>
@endif
