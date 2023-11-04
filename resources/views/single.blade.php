@extends('layouts.app')

@section('content')
  <section class="relative pb-4 pt-14 md:pt-10 md:pb-0 lg:pt-11">
    <x-container>
      <x-heading>
        @if (request()->routeIs('blog.detail'))
          <x-slot name="subheading">{{ __('Blog') }}</x-slot>
        @endif

        {!! $post->title !!}
      </x-heading>
    </x-container>

    {{-- Background --}}
    <img src="{{ asset('bg-dots.svg') }}" class="absolute -top-32 -right-[3px] -z-10 w-1/2" alt="">
  </section>

  <section class="relative pb-24 overflow-hidden">
    <x-container>
      <x-image
        :source="$post->cover?->url"
        :fallback="false"
        class="mb-8 lg:aspect-w-6 lg:aspect-h-2"
      />

      <div class="prose prose-neutral bg-[#f5f7fd] p-8 shadow-lg rounded-tl-3xl rounded-br-3xl [&>p:has(img)]:flex [&>p:has(img)]:justify-center [&>p>img]:max-h-96 [&>p>img]:w-auto [&>p>img]:m-0 [&>p>img]:rounded-xl">

        {!! $post->content !!}
      </div>
    </x-container>

    @if (!isset($relatedPosts) || $relatedPosts->isEmpty())
      <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 -z-10 max-w-[50%]">
    @endif
  </section>

  {{-- Related Posts --}}
  @if (request()->routeIs('blog.detail'))
    <section class="relative pb-40 overflow-hidden">
      @if ($relatedPosts->isNotEmpty())
        <x-container>
          <x-heading>
            <x-slot name="subheading">{{ __('Blog Terkait') }}</x-slot>
            {{ __('Postingan lain yang mungkin Anda suka') }}
          </x-heading>

          {{-- Posts --}}
          <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($relatedPosts as $post)
              @include('partials.blog-card', ['post' => $post])
            @endforeach
          </div>
        </x-container>
      @endif

      {{-- Background --}}
      <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 -z-10 max-w-[50%]">
    </section>
  @endif
@endsection
