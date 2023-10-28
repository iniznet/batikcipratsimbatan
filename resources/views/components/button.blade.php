@if ($type === 'link')
  <a {{ $attributes->twMerge($classes) }}>
    {{ $slot }}
  </a>
@else
  <button {{ $attributes->twMerge(['type' => 'button', 'class' => $classes]) }}>
    {{ $slot }}
  </button>
@endif


