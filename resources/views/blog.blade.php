@extends('layouts.app')

@section('content')
  <section class="relative pb-4 pt-14 md:pt-10 md:pb-0 lg:pt-11">
    <x-container>
      <x-heading>
        <x-slot name="subheading">{{ __('Blog') }}</x-slot>
        {{ __('Our Activity') }}
      </x-heading>
    </x-container>

    {{-- Background --}}
    <img src="{{ asset('bg-dots.svg') }}" class="absolute -top-32 -right-[3px] -z-10 w-1/2" alt="">
  </section>

  <section class="relative pb-40 overflow-hidden">
    <x-container>
      {{-- Big Card --}}
      @if ($post)
      <div class="grid gap-8 p-8 mb-24 shadow-lg rounded-tl-3xl rounded-br-3xl">
        {{-- Image --}}
        <a href="{{ route('blog.detail', $post->slug) }}">
          <x-image
            :source="$post->cover->url"
            class="lg:aspect-w-6 lg:aspect-h-2"
          />
        </a>

        {{-- Content --}}
        <div>
          {{-- Title --}}
          <a href="{{ route('blog.detail', $post->slug) }}">
            <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">{!! $post->title !!}
          </a>

          {{-- Excerpt --}}
          <p class="mt-4 text-base leading-7 text-gray-500 xl:text-lg 2xl:text-xl">{{ $post->excerpt }}</p>
        </div>

        <x-button
          :type="'link'"
          :color="''"
          :ring="false"
          :size="'lg'"
          :effects="['text']"
          href="{{ route('blog.detail', $post->slug) }}"
          class="!p-0 order-3 md:justify-end"
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

      {{-- Grid Blog 2 columns --}}
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($posts as $post)
          @include('partials.blog-card', ['background' => 'bg-[#f5f7fd]', 'post' => $post])
        @endforeach
      </div>

      {{-- Pagination --}}
      <div>
        {{ $posts->links() }}
      </div>
    </x-container>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 -z-10 max-w-[50%]">
  </section>
@endsection
