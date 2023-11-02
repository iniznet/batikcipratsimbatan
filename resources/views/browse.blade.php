@extends('layouts.app')

{{-- Shop --}}
@section('content')
  <section class="relative pb-4 pt-14 md:pt-10 md:pb-0 lg:pt-11">
    <x-container>
      <x-heading>
        <x-slot name="subheading">{{ __('Katalog') }}</x-slot>
        {{ __('Eksplorasi Seni dan Keindahan Produk-Produk Karya Pembatik Difabel') }}
      </x-heading>
    </x-container>

    {{-- Background --}}
    <img src="{{ asset('bg-dots.svg') }}" class="absolute -top-32 -right-[3px] -z-10 w-1/2" alt="">
  </section>

  <section class="relative pb-40 overflow-hidden pt-14">
    <x-container>
      <livewire:catalog />
    </x-container>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 z-0 max-w-[50%]">
  </section>
@endsection
