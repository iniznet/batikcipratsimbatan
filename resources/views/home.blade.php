@extends('layouts.app')

@section('hero')
  <section
    x-ignore
    ax-load
    x-data="carousel({effect: 'fade'})"
    class="relative w-full mx-auto overflow-hidden swiper-container"
  >
    <div class="swiper-wrapper max-h-96 lg:max-h-[30rem] 2xl:max-h-[32rem]">
      <div class="swiper-slide">
        <div class="aspect-w-16 aspect-h-9">
          <img src="{{ Vite::asset('resources/img/banner-1.jpg') }}" alt="" class="w-full">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="aspect-w-16 aspect-h-9">
          <img src="{{ Vite::asset('resources/img/banner-2.jpg') }}" alt="" class="w-full">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="aspect-w-16 aspect-h-9">
          <img src="{{ Vite::asset('resources/img/acara-1.jpg') }}" alt="" class="w-full">
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </section>

  <section class="py-12 bg-[#f8f9f9]">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <h3 class="text-2xl text-center md:text-4xl">Dengan keyakinan dalam dirimu,<br>Sungguh luar biasa apa yang bisa kita ciptakan bersama.</h2>
      <div class="relative flex justify-center w-16 py-2 mx-auto">
        <div class="after:absolute after:left-0 after:bottom-0 after:border-b-4 after:border-yellow-600 after:w-16"></div>
      </div>
      <p class="my-2 text-center md:text-xl opacity-90">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at malesuada nunc, in lobortis velit. Mauris id cursus mi. Fusce ut nibh eu mi iaculis sagittis eu eu enim. Pellentesque vestibulum sed ex non bibendum. Ut sit amet lorem sem. Vivamus pulvinar orci eget dui viverra volutpat. Suspendisse potenti.</p>
    </div>
  </section>
@endsection

@section('content')
  <section class="pt-12 pb-12 bg-gray-200 bg-pattern-1">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <h3 class="flex items-center justify-center mb-6 text-2xl md:text-4xl">
        <x-horizontal-line-dot direction="left" />
        <div class="px-4">
          <span class="text-yellow-600">Siapa</span>
          <span>Kami</span>
        </div>
        <x-horizontal-line-dot direction="right" />
      </h3>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <div class="pb-4 overflow-hidden text-center bg-white rounded-lg group">
          <div class="mb-4">
              <img class="object-cover w-full transition duration-300 max-h-56 group-hover:scale-110" src="{{ Vite::asset('resources/img/orang-1.jpg') }}" alt="photo">
          </div>
          <div class="text-center">
              <p class="text-xl font-bold">Lorem Ipsum</p>
              <p class="opacity-80">Pembatik</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="pt-12">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <h3 class="flex items-center justify-center mb-6 text-2xl md:text-4xl">
        <x-horizontal-line-dot direction="left" />
        <div class="px-4">
          <span class="text-yellow-600">Produk</span>
          <span>Unggulan</span>
        </div>
        <x-horizontal-line-dot direction="right" />
      </h3>

      {{-- Swiper Product Carousel --}}
      <div
        ax-load
        x-data="carousel({
          loop: false,
          autoplay: false,
          breakpoints: {
            640: {
              slidesPerView: 3,
            },
            768: {
              slidesPerView: 4,
            },
          },
          spaceBetween: 48,
        })"
        class="relative overflow-hidden swiper-container"
      >
        <div class="swiper-wrapper">
          @foreach (range(1, 10) as $product)
            <div class="swiper-slide">
              @include('partials.product-card', ['imageClass' => 'aspect-w-3 aspect-h-4'])
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="pt-12 pb-12">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <h3 class="flex items-center justify-center mb-6 text-2xl md:text-4xl">
        <x-horizontal-line-dot direction="left" />
        <div class="px-4">
          <span class="text-yellow-600">Produk</span>
          <span>Terbaru</span>
        </div>
        <x-horizontal-line-dot direction="right" />
      </h3>

      <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
        @foreach (range(1, 6) as $product)
          @include('partials.product-card')
        @endforeach
      </div>
    </div>
  </section>

  <section class="pt-12 pb-12 bg-[#e7e7e7]">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <h3 class="flex items-center justify-center mb-6 text-2xl md:text-4xl">
        <x-horizontal-line-dot direction="left" />
        <div class="px-4">
          <span>Blog</span>
        </div>
        <x-horizontal-line-dot direction="right" />
      </h3>

      <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
        {{-- Big card --}}
        <div class="lg:col-start-3 lg:col-end-6 lg:order-2">
          <div class="p-4 bg-white rounded group">
            <div class="mb-4 overflow-hidden rounded aspect-w-6 aspect-h-4">
              <img class="object-cover w-full transition duration-500 group-hover:scale-110" src="{{ Vite::asset('resources/img/acara-1.jpg') }}" alt="photo">
            </div>
            <div>
              <p class="text-xl font-bold">Lorem Ipsum</p>
              {{-- Time & Username --}}
              <div class="flex py-2 text-sm text-gray-500 flex-warp">
                <p>1 Januari 2021</p>
                <span class="mx-2">/</span>
                <p>Oleh: Lorem Ipsum</p>
              </div>
              <p class="opacity-80">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at malesuada nunc, in lobortis velit. Mauris id cursus mi. Fusce ut nibh eu mi iaculis sagittis eu eu enim....</p>
              <a href="#" class="inline-block mt-4 text-yellow-600">Baca Selengkapnya</a>
            </div>
          </div>
        </div>

        {{-- List small card --}}
        <div class="lg:col-start-1 lg:col-end-3 lg:order-1">
          @foreach (range(1, 3) as $blog)
            <div class="p-4 mb-4 bg-white rounded group">
              <div class="float-left w-32 mr-4 overflow-hidden rounded">
                <img class="object-cover object-center transition duration-300 group-hover:scale-110" src="{{ Vite::asset('resources/img/acara-' . rand(2, 3) . '.jpg') }}" alt="photo">
              </div>
              <div>
                <div class="flex pb-2 text-sm text-gray-500 flex-warp">
                  <p>1 Januari 2021</p>
                </div>
                <p class="text-xl font-bold">Lorem Ipsum</p>
                <p class="text-sm opacity-80">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at malesuada nunc, in lobortis velit. Mauris id cursus mi. Fusce ut nibh eu mi iaculis sagittis eu eu enim....</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection
