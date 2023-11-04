@extends('layouts.app')

@section('content')
  <section class="relative pb-4 pt-14 md:pt-10 md:pb-0 lg:pt-11">
    <x-container>
      <div class="grid gap-8 lg:grid-cols-7">
        <div class="col-span-3">
          {{-- Gallery Swiper --}}
          <div
            x-ignore
            ax-load
            x-data="gallery"
            class="space-y-2"
          >
            {{-- Featured Swiper --}}
            <div
              x-ref="featuredEl"
              class="relative swiper"
            >
              <div class="swiper-wrapper">
                @foreach ($product->productPictures as $image)
                  <div class="swiper-slide">
                    <x-image
                      :source="$image->url"
                      class="object-cover w-full h-full"
                    />
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Thumbnails Swiper --}}
            <div
              x-ref="thumbsEl"
              class="relative swiper"
            >
              <div class="swiper-wrapper max-h-[20%]">
                @foreach ($product->productPictures as $image)
                  <div class="swiper-slide opacity-40">
                    <img src="{{ $image->url }}" class="object-cover w-full h-full" alt="">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        <div class="col-span-4">
          <x-heading
            class="!mb-0 lg:pt-4"
          >
            <x-slot name="subheading">{{ __('Rp ') . number_format($product->price, 0, ',', '.') }}</x-slot>
            {{ $product->title }}
          </x-heading>

          {{-- Description --}}
          <div class="mb-4 space-y-4">
            {!! $product->content !!}
          </div>

          {{-- Contact Admin to Buy --}}
          <div class="border-t border-t-[#a5b5e6] py-4">
            {{-- Sentence: Interested to buy? --}}
            <strong class="mb-4">
              {{ __('Tertarik untuk membeli?') }}
            </strong>

            {{-- Contact Admin --}}
            <div class="flex items-center space-x-4">
              @foreach (config('settings.whatsapp_numbers', []) as $data)
                <x-button
                  :type="'link'"
                  href="{{ sprintf('//api.whatsapp.com/send?phone=%s&text=%s', $data['phone'], urlencode(__('Halo, saya tertarik untuk membeli produk ' . $product->title))) }}"
                  target="_blank"
                  class="flex items-center space-x-2"
                >
                  <x-lucide>
                    <x-lucide-phone class="w-5 h-5" />
                  </x-lucide>
                  <span>{{ __('Hubungi Admin') . ' ' . $loop->iteration }}</span>
                </x-button>
              @endforeach
            </div>
          </div>

          {{-- Meta (Category, Materials) --}}
          <div class="border-t border-t-[#a5b5e6] py-4">
            {{-- Category --}}
            <div class="flex flex-wrap items-center space-x-2">
              <strong>{{ __('Kategori') }}: </strong>
              <a href="{{ route('catalog', ['cat' => [$product->category->id]]) }}" class="text-sm text-blue-500 hover:underline" wire:navigate.hover>{{ $product->category->name }}</a>
            </div>

            {{-- Materials --}}
            <div class="flex flex-wrap items-center space-x-2">
              <strong>{{ __('Bahan') }}: </strong>
              <a href="{{ route('catalog', ['mat' => [$product->material->id]]) }}" class="text-sm text-blue-500 hover:underline" wire:navigate.hover>{{ $product->material->name }}</a>
            </div>
          </div>
        </div>
      </div>
    </x-container>

    {{-- Background --}}
    <img src="{{ asset('bg-dots.svg') }}" class="absolute -top-32 -right-[3px] -z-10 w-1/2" alt="">
  </section>

  {{-- Related Products --}}
  <section class="relative pb-40 overflow-hidden pt-14">
    @if ($relatedProducts->isNotEmpty())
      <x-container>
        <x-heading>
          <x-slot name="subheading">{{ __('Produk Terkait') }}</x-slot>
          {{ __('Produk-produk lain yang mungkin Anda suka') }}
        </x-heading>

        {{-- Products --}}
        <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($relatedProducts as $product)
            @include('partials.product-card', ['product' => $product])
          @endforeach
        </div>
      </x-container>
    @endif

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 -z-10 max-w-[50%]">
  </section>
@endsection
