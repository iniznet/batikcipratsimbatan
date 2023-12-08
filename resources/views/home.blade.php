@extends('layouts.app')

@section('content')
  {{-- What we do --}}
  <section class="relative pb-6 pt-14 md:pt-10 md:pb-0 lg:pt-11 lg:pb-9 2xl:pt-12 2xl:pb-14">
    {{-- container --}}
    <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
      {{-- Hero --}}
      <div
        x-data="{ visible: false }"
        x-init="visible = true"
        class="grid-cols-2 gap-4 lg:grid"
      >
        {{-- Left --}}
        <div class="mb-8 left lg:pt-16 md:m-0 font-heading">
          <div
            class="overflow-hidden"
            data-scroll
            data-scroll-speed="-0.1"
          >
            <div
              class="text-xl text-[rgb(34,34,34)] mb-2 tracking-wide 2xl:text-3xl transition-transform duration-1000 translate-y-[120%]"
              :class="visible && '!translate-y-0'"
            >{{ __('Tugas Kami') }}</div>
          </div>
          <div
            class="overflow-hidden"
            data-scroll
            data-scroll-speed="-0.2"
          >
            <h1
              class="text-4xl sm:text-5xl md:text-6xl font-bold text-[#222] mb-4 max-w-3xl 2xl:text-8xl transition-transform duration-1000 translate-y-[120%] delay-75"
              :class="visible && '!translate-y-0'"
            >{{ config('settings.tagline') }}</h1>
          </div>

          {{-- Buttons --}}
          <div
            class="overflow-hidden"
            data-scroll
            data-scroll-speed="-0.2"
          >
            <div
              class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0 transition-transform duration-1000 translate-y-[120%] delay-150"
              :class="visible && '!translate-y-0'"
            >
              <x-button
                :type="'link'"
                :color="''"
                :size="'lg'"
                :padding="false"
                :effects="null"
                :ring="false"
                href="{{ config('home_settings.video_url', '#') }}"
                class="2xl:text-3xl"
                data-fancybox
              >
                <x-lucide
                  :color="'primary'"
                  :size="'lg'"
                  :effects="['background', 'scale-in']"
                  class="lg:p-6 2xl:p-8"
                >
                  <x-lucide-play :class="'w-6 h-6 fill-white'" />
                </x-lucide>

                <span class="font-semibold uppercase">{{ __('Tonton Video Profil') }}</span>
              </x-button>
            </div>
          </div>
        </div>

        {{-- Right --}}
        <div class="grid self-end grid-cols-3 gap-4 -mx-9 md:m-0">
          <div class="self-center space-y-4">
            <div
              class="overflow-hidden"
              data-scroll
              data-scroll-speed="-0.1"
            >
              <x-image
                class="aspect-w-4 aspect-h-5 transition-transform duration-1000 translate-y-[120%] delay-75"
                x-bind:class="visible && '!translate-y-0'"
                :source="$featureds[0]['url'] ?? ''"
              />
            </div>
          </div>
          <div class="self-center space-y-4 lg:pb-32">
            <div
              class="overflow-hidden"
              data-scroll
              data-scroll-speed="0.1"
            >
              <x-image
                class="aspect-w-4 aspect-h-5 transition-transform duration-1000 translate-y-[-120%] delay-150"
                x-bind:class="visible && '!translate-y-0'"
                :source="$featureds[1]['url'] ?? ''"
              />
            </div>
            <div
              class="overflow-hidden"
              data-scroll
              data-scroll-speed="0.1"
            >
              <x-image
                class="aspect-w-4 aspect-h-5 transition-transform duration-1000 translate-y-[120%] delay-150"
                x-bind:class="visible && '!translate-y-0'"
                :source="$featureds[2]['url'] ?? ''"
              />
            </div>
          </div>
          <div class="self-center pb-12 space-y-4 lg:p-0">
            <div
              class="overflow-hidden"
              data-scroll
              data-scroll-speed="-0.1"
            >
              <x-image
                class="aspect-w-4 aspect-h-5 transition-transform duration-1000 translate-y-[-120%] delay-75"
                x-bind:class="visible && '!translate-y-0'"
                :source="$featureds[3]['url'] ?? ''"
              />
            </div>
            <div
              class="overflow-hidden"
              data-scroll
              data-scroll-speed="-0.1"
            >
              <x-image
                class="aspect-w-4 aspect-h-5 transition-transform duration-1000 translate-y-[120%] delay-75"
                x-bind:class="visible && '!translate-y-0'"
                :source="$featureds[4]['url'] ?? ''"
              />
            </div>
          </div>
        </div>
      </div>

      {{-- Social Icons --}}
      <div
        class="flex justify-between mb-8 font-heading lg:justify-start lg:gap-4 lg:-mt-16"
        data-scroll
        data-scroll-speed="0.03"
      >
        @foreach ($socials as $social)
          <x-button
            :type="'link'"
            :color="'tertiary'"
            :effects="['scale-in']"
            :ring="false"
            :shape="'circle'"
            href="{{ $social['link'] }}"
            class="px-3 py-3 md:py-2 2xl:text-xl"
            target="_blank"
          >
            <x-lucide
              :effects="['opacity']"
            >
              <x-dynamic-component :component="'simpleicon-' . strtolower($social['name'])" class="w-7 h-7 2xl:w-8 2xl:h-8" style="color: #0866FF" />
            </x-lucide>
            <span class="hidden md:block">{{ $social['name'] }}</span>
          </x-button>
        @endforeach
      </div>

      <div class="hero-waves absolute bottom-0 right-0 w-full max-h-[55%] -z-10">
        <svg viewBox="0 0 1440 637" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(0.000000, 0.943000)">
            <path d="M1440,54.883 L2.27373675e-13,394.154185 L2.27373675e-13,635.23 C396.995,362.084 1134.556,330.93 1440,111.847 C1440,111.847 1440,54.883 1440,54.883 Z" id="wave-2" fill="#5b71b9" fill-rule="nonzero"></path>
            <path d="M1439.95294,0 C1234.52116,65.3428601 1089.29589,104.290339 1004.27713,116.842437 C727.478159,157.708805 614.214121,148.327015 386.099997,184.843756 C234.023915,209.18825 105.323916,248.628834 6.82121026e-13,303.165508 L6.82121026e-13,468.943 C390.408241,211.815 971.55225,291.397 1439.95294,54.883 C1440.05882,54.768952 1439.95294,0 1439.95294,0 Z" id="wave-1" fill="#9f9fd9" fill-rule="nonzero"></path>
          </g>
        </svg>
      </div>

      {{-- Newsletter --}}
      <livewire:newsletter />
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots.svg') }}" class="absolute -top-32 -right-[3px] z-0 w-1/2" alt="">
  </section>

  {{-- Who we are --}}
  <section
    x-data="{ shown: false }"
    x-intersect:enter="shown = true"
    class="relative pt-24 pb-40 overflow-hidden"
  >
    {{-- container --}}
    <div
      class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto"
      x-transition:enter="transition ease-in-out duration-1000"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-show="shown"
      x-cloak
    >
      {{-- Heading --}}
      <div class="mb-8 md:mb-16 lg:pt-16 font-heading 2xl:pr-44">
        <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">{{ __('Siapa Kami') }}</div>
        <h2 class="text-3xl font-bold text-[#222] mb-4 max-w-5xl xl:text-5xl 2xl:text-6xl">{{ config('home_settings.about_title') }}</h2>
      </div>

      {{-- Image - Description --}}
      <div class="grid-cols-7 gap-20 lg:grid">
        {{-- Left --}}
        <div class="col-span-4 mb-8" data-scroll data-scroll-speed="-0.05">
          <x-image
            :source="$aboutImage?->url"
            class="aspect-w-3 aspect-h-2 lg:!aspect-h-[1.5]"
          />
        </div>

        {{-- Right --}}
        <div class="max-w-xl col-span-3 space-y-8 text-xl md:text-xl">
          <p class="2xl:text-2xl">{{ config('home_settings.about_desc') }}</p>

          <div class="rounded-tl-[40px] rounded-br-[40px] bg-[#f5f7fd] flex py-8 px-10 gap-4 md:gap-8">
            {{-- Left --}}
            <div class="flex-shrink">
              <x-lucide
                :color="'secondary'"
                :shape="'circle'"
                class="p-2 lg:p-4 xl:p-6"
              >
                <x-lucide-megaphone class="w-10 h-10 text-white transform md:w-14 md:h-14 -rotate-12" />
              </x-lucide>
            </div>

            {{-- Right --}}
            <div class="flex-grow">
              <h5 class="md:text-2xl xl:text-3xl font-semibold text-[#006ce2] font-heading">{{ config('home_settings.about_tagline') }}</h5>
            </div>
          </div>

          <x-button
            :type="'link'"
            :color="''"
            :ring="false"
            :size="'lg'"
            :effects="['text']"
            class="2xl:text-3xl"
            href="/tentang-kami"
          >
            <span class="uppercase">{{ __('Selengkapnya Tentang Kami') }}</span>
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
      </div>
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 z-0 max-w-[50%]">
  </section>

  {{-- What we do --}}
  <section
    x-data="{ shown: false }"
    x-intersect:enter="shown = true"
    class="relative pb-40 overflow-hidden pt-24 bg-[#f9fafc]"
  >
    {{-- container --}}
    <div
      class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto"
      x-transition:enter="transition ease-in-out duration-1000"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-show="shown"
      x-cloak
    >
      {{-- Heading --}}
      <div class="mb-8 md:mb-16 lg:pt-16 font-heading 2xl:pr-44">
        <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">{{ __('Kegiatan Kami') }}</div>
        <h2 class="text-2xl xl:text-4xl font-bold text-[#222] mb-4 2xl:text-6xl">{{ config('home_settings.activity_title') }}</h2>
      </div>

      {{-- Cards --}}
      <div class="grid gap-8 lg:grid-cols-3">
        @include('partials.blog-card', ['post' => $post])

        @foreach ($posts as $post)
          @include('partials.blog-card', ['reverse' => true, 'post' => $post])
        @endforeach
      </div>
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 z-0 max-w-[50%]">
  </section>

  {{-- E-Catalogue --}}
  <section
    x-data="{ shown: false }"
    x-intersect:enter="shown = true"
    class="relative pt-24 pb-24 overflow-hidden"
  >
    {{-- container --}}
    <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto"
      x-transition:enter="transition ease-in-out duration-1000"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-show="shown"
      x-cloak
    >
      {{-- Heading --}}
      <div class="mb-8 text-center md:mb-16 lg:pt-16 font-heading">
        <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">{{ __('eKatalog') }}</div>
        <h2 class="text-2xl xl:text-4xl font-bold text-[#222] mb-4 2xl:text-6xl">{{ config('home_settings.catalog_title') }}</h2>
        <p class="inline-flex max-w-4xl font-sans text-xl md:text-2xl">{{ config('home_settings.catalog_desc') }}</p>
      </div>

      {{-- Iframe --}}
      <div class="lg:px-40">
        <div class="relative z-10 p-8 rounded-tl-[40px] rounded-br-[40px] overflow-hidden bg-[#f5f7fd]">
          <div class="aspect-w-16 aspect-h-9 rounded-tl-[40px] rounded-br-[40px] overflow-hidden">
            <iframe src="{{ config('home_settings.catalog_iframe_url') }}" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute right-0 lg:top-60 -z-10 max-w-[50%]">
  </section>

  {{-- Contact Us --}}
  <section
    x-data="{ shown: false }"
    x-intersect:enter="shown = true"
    class="relative pt-24 pb-24 overflow-hidden bg-[#f9fafc]"
  >
    {{-- container --}}
    <div
      class="relative z-10 md:px-5 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto"
      x-transition:enter="transition ease-in-out duration-1000"
      x-transition:enter-start="opacity-0 transform translate-y-1/2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-show="shown"
      x-cloak
    >
      <div class="bg-[#006ce2] py-20 px-4 md:p-12 lg:p-16 md:rounded-3xl lg:rounded-[40px] grid lg:grid-cols-2 gap-10">
        {{-- Left - Heading --}}
        <div class="text-white font-heading">
          <div class="mb-4 text-xl tracking-wide 2xl:text-3xl">{{ __('Hubungi Kami') }}</div>
          <h2 class="mb-4 text-3xl font-bold md:text-5xl 2xl:text-6xl">{{ __('Dapatkan informasi lebih lanjut melalui WhatsApp.') }}</h2>
        </div>

        {{-- Right --}}
        <div>
          {{-- Form --}}
          <form
            x-ignore
            ax-load="visible"
            x-data="contactForm('{{ $phone }}', {
              opening: '{{ $openingMessage }}',
              topic: '{{ $topicMessage }}',
              closing: '{{ $closingMessage }}',
            })"
            class="space-y-8"
          >
            {{-- Name --}}
            <div class="flex flex-col space-y-2">
              <label for="name" class="text-lg font-semibold text-white font-heading">{{ __('Nama') }}</label>
              <input type="text" x-model="name" class="w-full px-6 py-4 text-lg rounded-full shadow outline-none focus:shadow-inner" placeholder="{{ __('Nama') }}">
            </div>

            {{-- Topic --}}
            <div class="flex flex-col space-y-2">
              <label for="topic" class="text-lg font-semibold text-white font-heading">{{ __('Topik') }}</label>
              <input type="text" x-model="topic" class="w-full px-6 py-4 text-lg rounded-full shadow outline-none focus:shadow-inner" placeholder="{{ __('Topik') }}">
            </div>

            {{-- Message --}}
            <div class="flex flex-col space-y-2">
              <label for="message" class="text-lg font-semibold text-white font-heading">{{ __('Pesan') }}</label>
              <textarea x-model="message" class="w-full px-6 py-4 text-lg shadow outline-none rounded-2xl focus:shadow-inner" placeholder="{{ __('Pesan') }}" rows="4"></textarea>
            </div>

            {{-- Submit --}}
            <button
              @click.prevent="send"
              type="submit"
              class="w-full py-4 px-6 rounded-full shadow text-lg outline-none focus:shadow-inner bg-[#ff5729] text-white font-semibold uppercase tracking-wider"
            >{{ __('Kirim') }}</button>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
