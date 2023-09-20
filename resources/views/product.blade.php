@extends('layouts.app')

@section('hero')
  @include('partials.breadcrumb')
@endsection

@section('content')
  {{-- Product Detail --}}
  <section class="py-12">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">
        {{-- Product Image --}}
        <div class="relative w-full h-96">
          <div class="absolute inset-0 flex items-center justify-center w-full h-full">
            <img
              src="https://source.unsplash.com/random/400x400"
              alt="Product Image"
              class="object-contain w-full h-full"
            />
          </div>
        </div>

        {{-- Product Details --}}
        <div>
          {{-- Product Name --}}
          <div>
            <h1 class="text-2xl font-semibold text-gray-800">Nama Produk</h1>
          </div>

          {{-- Product Price --}}
          <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800">Rp. 100.000</h2>
          </div>

          {{-- Product Description, Category, Material, Stock, Quantity --}}
          <div class="mb-8">
            <p class="text-gray-600">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, quos? Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, quos? Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, quos?
            </p>
            <ul class="mt-4 space-y-2">
              <li>
                <span class="font-semibold text-gray-800">Kategori:</span>
                <a href="#" class="text-yellow-600">Kategori</a>
              </li>
              <li>
                <span class="font-semibold text-gray-800">Material:</span>
                <span class="text-gray-600">Material</span>
              </li>
              <li>
                <span class="font-semibold text-gray-800">Stock:</span>
                <span class="text-gray-600">100</span>
              </li>
              <li>
                <span class="font-semibold text-gray-800">Jumlah:</span>
                <input
                  type="number"
                  class="w-full px-4 py-2 text-lg text-gray-800 transition duration-500 border rounded-md focus:border-yellow-600 focus:outline-none"
                />
              </li>
            </ul>
          </div>

          {{-- Product Add To Cart, Buy via Whatsapp, Buy via Tokopedia --}}
          <div class="flex flex-wrap gap-4">
            <button
              type="button"
              class="flex items-center justify-center flex-grow px-4 py-2 text-lg font-medium text-white transition duration-500 transform bg-yellow-600 rounded-md hover:scale-110 hover:bg-yellow-500"
            >
              <x-lucide-shopping-basket class="w-6 h-6 mr-2" />
              <span>Tambahkan Keranjang</span>
            </button>

            <button
              type="button"
              class="flex items-center justify-center flex-grow px-4 py-2 text-lg font-medium text-white transition duration-500 transform bg-green-600 rounded-md hover:scale-110 hover:bg-green-500"
            >
              <x-lucide-smartphone class="w-6 h-6 mr-2" />
              <span>Beli via Whatsapp</span>
            </button>

            <button
              type="button"
              class="flex items-center justify-center flex-grow px-4 py-2 text-lg font-medium text-white transition duration-500 transform bg-green-600 rounded-md hover:scale-110 hover:bg-green-500"
            >
              <x-lucide-shopping-cart class="w-6 h-6 mr-2" />
              <span>Beli via Tokopedia</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Related Products
  <section class="pt-12">
    <div class="w-full max-w-5xl px-4 mx-auto">
      <h3 class="flex items-center justify-center mb-6 text-2xl md:text-4xl">
        <x-horizontal-line-dot direction="left" />
        <div class="px-4">
          <span class --}}
@endsection
