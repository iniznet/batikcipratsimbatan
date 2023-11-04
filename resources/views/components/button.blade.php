@if ($type === 'link')
  <a {{ $attributes->twMerge($classes)->except('type') }}>
    {{ $slot }}
  </a>
@else
  <button {{ $attributes->twMerge(['type' => 'button', 'class' => $classes]) }}>
    {{ $slot }}
  </button>
@endif


