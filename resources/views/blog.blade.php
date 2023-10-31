@extends('layouts.app')

@section('content')
  <section class="relative pb-4 pt-14 md:pt-10 md:pb-0 lg:pt-11">
    <x-container>
      <x-heading>
        <x-slot name="subheading">{{ __('Blog') }}</x-slot>
        {{ __('Our Activity') }}
      </x-heading>
    </x-container>
  </section>

  {{-- Grid Blog 2 columns --}}
  <section class="relative pb-40 overflow-hidden">
    <x-container>
      {{-- Big Card --}}
      <div class="grid gap-8 p-8 mb-24 shadow-lg rounded-tl-3xl rounded-br-3xl">
        {{-- Image --}}
        <div>
          <x-image
            :source="'/build/assets/acara-1-fddba1a3.jpg'"
            class="lg:aspect-w-6 lg:aspect-h-2"
          />
        </div>

        {{-- Content --}}
        <div>
          {{-- Title --}}
          <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">Lorem ipsum dolor sit amet consectetur adipiscing elit</h5>
          {{-- Excerpt --}}
          <p class="mt-4 text-base leading-7 text-gray-500 xl:text-lg 2xl:text-xl">Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
        </div>

        <x-button
          :type="'link'"
          :color="''"
          :ring="false"
          :size="'lg'"
          :effects="['text']"
          href="https://www.facebook.com/edcampua"
          class="!p-0 order-3 md:justify-end"
        >
          <span class="uppercase">Baca Selengkapnya</span>
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

      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
        @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]'])
      </div>
    </x-container>
  </section>

  {{-- Pagination --}}

@endsection
