{{-- Product Card --}}
<a href="{{ route('product.detail', $product->slug) }}" wire:navigate.hover>
  <div class="p-4 space-y-4 transition bg-white border border-gray-200 rounded-md shadow-md hover:shadow-lg hover:-translate-y-1">
    {{-- Image --}}
    <x-image
      :source="$product->cover?->url"
      class="lg:aspect-w-1 lg:aspect-h-1"
    />

    <div>
      {{-- Name --}}
      <h5 class="text-lg font-semibold">{{ $product->title }}</h5>

      {{-- Price --}}
      <h6 class="text-lg font-semibold text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</h6>
    </div>
  </div>
</a>
