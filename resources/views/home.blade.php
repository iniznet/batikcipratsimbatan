@extends('layouts.app')

@section('content')
  {{-- What we do --}}
  <section class="relative pb-6 pt-14 md:pt-10 md:pb-0 lg:pt-11 lg:pb-9 2xl:pt-12 2xl:pb-14">
    {{-- container --}}
    <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
      {{-- Hero --}}
      <div class="grid-cols-2 gap-4 lg:grid">
        {{-- Left --}}
        <div class="mb-8 left lg:pt-16 md:m-0 font-heading">
          <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">Tugas Kami</div>
          <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-[#222] mb-4 max-w-3xl 2xl:text-8xl">Menyatukan dan Mengembangkan Para Difabel</h1>

          {{-- Buttons --}}
          <div class="flex">
            <x-button
              :type="'link'"
              :color="''"
              :size="'lg'"
              :padding="false"
              :effects="null"
              :ring="false"
              href="https://www.youtube.com/watch?v=AnzFSAWeWoI"
              data-fancybox=""
            >
              <x-lucide
                :color="'primary'"
                :size="'lg'"
                :effects="['background', 'scale-in']"
                class="lg:p-6 2xl:p-8"
              >
                <x-lucide-play :class="'w-6 h-6 fill-white'" />
              </x-lucide>

              <span class="font-semibold uppercase">Tonton Video Profil</span>
            </x-button>
          </div>
        </div>

        {{-- Right --}}
        <div class="grid self-end grid-cols-3 gap-4 -mx-9 md:m-0">
          <div class="self-center space-y-4">
            <x-image class="aspect-w-4 aspect-h-5" :source="'/build/assets/acara-1-fddba1a3.jpg'" />
          </div>
          <div class="self-center space-y-4 lg:pb-32">
            <x-image class="aspect-w-4 aspect-h-5" :source="'/build/assets/acara-4-7f08c89e.png'" />
            <x-image class="aspect-w-4 aspect-h-5" :source="'/build/assets/banner-1-57c6b73b.jpg'" />
          </div>
          <div class="self-center pb-12 space-y-4 lg:p-0">
            <x-image class="aspect-w-4 aspect-h-5" :source="'/build/assets/banner-2-f6385ddf.jpg'" />
            <x-image class="aspect-w-4 aspect-h-5" :source="'/build/assets/acara-6-37d5c99f.jpg'" />
          </div>
        </div>
      </div>

      {{-- Social Icons --}}
      <div class="flex justify-between mb-8 font-heading lg:justify-start lg:gap-4 lg:-mt-16">
        <x-button
          :type="'link'"
          :color="'tertiary'"
          :effects="['scale-in']"
          :ring="false"
          :shape="'circle'"
          href="https://www.facebook.com/edcampua"
          class="px-3 py-3 md:py-2"
          target="_blank"
        >
          <x-lucide
            :effects="['opacity']"
          >
            <x-simpleicon-facebook class="w-7 h-7" style="color: #0866FF" />
          </x-lucide>
          <span class="hidden md:block">Facebook</span>
        </x-button>
        <x-button
          :type="'link'"
          :color="'tertiary'"
          :effects="['scale-in']"
          :ring="false"
          :shape="'circle'"
          href="https://www.facebook.com/edcampua"
          class="px-3 py-3 md:py-2"
          target="_blank"
        >
          <x-lucide
            :effects="['opacity']"
          >
            <x-simpleicon-instagram class="w-7 h-7" style="color: #E4405F" />
          </x-lucide>
          <span class="hidden md:block">Instagram</span>
        </x-button>
        <x-button
          :type="'link'"
          :color="'tertiary'"
          :effects="['scale-in']"
          :ring="false"
          :shape="'circle'"
          href="https://www.facebook.com/edcampua"
          class="px-3 py-3 md:py-2"
          target="_blank"
        >
          <x-lucide
            :effects="['opacity']"
          >
            <x-simpleicon-youtube class="w-7 h-7" style="color: #FF0000" />
          </x-lucide>
          <span class="hidden md:block">Youtube</span>
        </x-button>
        <x-button
          :type="'link'"
          :color="'tertiary'"
          :effects="['scale-in']"
          :ring="false"
          :shape="'circle'"
          href="https://www.facebook.com/edcampua"
          class="px-3 py-3 md:py-2"
          target="_blank"
        >
          <x-lucide
            :effects="['opacity']"
          >
            <x-simpleicon-twitter class="w-7 h-7" style="color: #1D9BF0" />
          </x-lucide>
          <span class="hidden md:block">Twitter</span>
        </x-button>
        <x-button
          :type="'link'"
          :color="'tertiary'"
          :effects="['scale-in']"
          :ring="false"
          :shape="'circle'"
          href="https://www.facebook.com/edcampua"
          class="px-3 py-3 md:py-2"
          target="_blank"
        >
          <x-lucide
            :effects="['opacity']"
          >
            <x-simpleicon-shopee class="w-7 h-7" style="color: #EE4D2D" />
          </x-lucide>
          <span class="hidden md:block">Shopee</span>
        </x-button>
      </div>

      {{-- Newsletter (Disabled) --}}
      {{-- <div class="bg-[#f5f7fd] gap-4 p-8 md:p-12 rounded-3xl grid grid-areas-newsletter grid-cols-newsletter lg:grid-areas-newsletter__dekstop lg:grid-cols-newsletter__dekstop">
        <div class="grid-in-icon">
          <x-lucide
            :color="'secondary'"
            :size="'lg'"
            :shape="'circle'"
            class="xl:p-6"
          >
            <x-lucide-mail class="w-10 h-10 text-white" />
          </x-lucide>
        </div>

        <div class="self-center grid-in-title">
          <h4 class="text-3xl font-semibold font-heading">Nawala Kami</h4>
        </div>

        <div class="text-2xl grid-in-message">
          <p>Berlangganan nawala kami untuk mendapatkan informasi terbaru dari kami.</p>
        </div>

        <div class="text-2xl grid-in-form">
          <h4 class="mb-4 text-3xl font-semibold font-heading">Masukkan Email</h4>
          <form class="relative">
            <input type="email" class="w-full py-6 pl-8 pr-20 mb-4 rounded-full shadow outline-none focus:shadow-inner xl:m-0" placeholder="Email">
            <button type="submit" class="xl:absolute font-semibold right-0 h-full z-10 px-10 py-4 text-white rounded-full bg-[#ff5729] uppercase tracking-wider">Berlanggan</button>
          </form>
        </div>
      </div> --}}
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots.svg') }}" class="absolute -top-32 -right-[3px] z-0 w-1/2" alt="">
  </section>

  {{-- Who we are --}}
  <section class="relative pt-24 pb-40 overflow-hidden">
    {{-- container --}}
    <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
      {{-- Heading --}}
      <div class="mb-8 md:mb-16 lg:pt-16 font-heading 2xl:pr-44">
        <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">Siapa Kami</div>
        <h2 class="text-3xl font-bold text-[#222] mb-4 max-w-5xl xl:text-5xl 2xl:text-6xl">Kami merupakan sebuah komunitas pembatik yang berdedikasi untuk mengangkat kreativitas difabel melalui seni tradisional pembatikan.</h2>
      </div>

      {{-- Image - Description --}}
      <div class="grid-cols-7 gap-20 lg:grid">
        {{-- Left --}}
        <div class="col-span-4 mb-8">
          <x-image
            :source="'/build/assets/acara-5-b4b78994.png'"
            class="aspect-w-3 aspect-h-2 lg:!aspect-h-[1.5]"
          />
        </div>

        {{-- Right --}}
        <div class="max-w-xl col-span-3 space-y-8 text-xl md:text-xl">
          <p>Yang paling penting adalah kami memotivasi para difabel untuk tumbuh dan berbagi pengalaman, ide, dan inspirasi mereka satu sama lain, menjadi bahagia dan efisien secara umum dalam kehidupan.</p>

          <div class="rounded-tl-[40px] rounded-br-[40px] bg-[#f5f7fd] flex py-8 px-10 gap-4 md:gap-8">
            {{-- Left --}}
            <div class="flex-shrink">
              <x-lucide
                :color="'secondary'"
                :shape="'circle'"
                class="p-2 lg:p-4 xl:p-6"
              >
                <x-lucide-megaphone class="text-white transform w-10 h-10 md:w-14 md:h-14 -rotate-12" />
              </x-lucide>
            </div>

            {{-- Right --}}
            <div class="flex-grow">
              <h5 class="md:text-2xl xl:text-3xl font-semibold text-[#006ce2] font-heading">Kami membangun sebuah komunitas yang bertanggung jawab</h5>
            </div>
          </div>

          <x-button
            :type="'link'"
            :color="''"
            :ring="false"
            :size="'lg'"
            :effects="['text']"
            href="https://www.facebook.com/edcampua"
          >
            <span class="uppercase">Selengkapnya Tentang Kami</span>
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
  <section class="relative pb-40 overflow-hidden pt-24 bg-[#f9fafc]">
    {{-- container --}}
    <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
      {{-- Heading --}}
      <div class="mb-8 md:mb-16 lg:pt-16 font-heading 2xl:pr-44">
        <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">Kegiatan Kami</div>
        <h2 class="text-2xl xl:text-4xl font-bold text-[#222] mb-4 2xl:text-6xl">Aktivitas sehari-hari kami</h2>
      </div>

      {{-- Cards --}}
      <div class="grid gap-8 lg:grid-cols-3">
        {{-- Card --}}
        <div class="grid gap-8 p-8 bg-white shadow-lg rounded-tl-3xl rounded-br-3xl">
          {{-- Image --}}
          <div>
            <x-image
              :source="'/build/assets/acara-1-fddba1a3.jpg'"
              class="lg:!aspect-h-[1]"
            />
          </div>

          {{-- Content --}}
          <div>
            <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">Lorem ipsum dolor sit amet consectetur adipiscing elit</h5>
          </div>

          <x-button
            :type="'link'"
            :color="''"
            :ring="false"
            :size="'lg'"
            :effects="['text']"
            href="https://www.facebook.com/edcampua"
            class="!p-0 order-3 md:justify-start"
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

        {{-- Card --}}
        <div class="grid gap-8 p-8 bg-white shadow-lg rounded-tl-3xl rounded-br-3xl">
          {{-- Image --}}
          <div class="order-2">
            <x-image
              :source="'/build/assets/acara-2-21ec201a.jpg'"
              class="lg:!aspect-h-[1]"
            />
          </div>

          {{-- Content --}}
          <div>
            <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">Lorem ipsum dolor sit amet consectetur adipiscing elit</h5>
          </div>

          <x-button
            :type="'link'"
            :color="''"
            :ring="false"
            :size="'lg'"
            :effects="['text']"
            href="https://www.facebook.com/edcampua"
            class="!p-0 order-3 md:justify-start"
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

        {{-- Card --}}
        <div class="grid gap-8 p-8 bg-white shadow-lg rounded-tl-3xl rounded-br-3xl">
          {{-- Image --}}
          <div class="order-2">
            <x-image
              :source="'/build/assets/acara-3-438f4a90.jpg'"
              class="lg:!aspect-h-[1]"
            />
          </div>

          {{-- Content --}}
          <div>
            <h5 class="text-2xl font-semibold xl:text-3xl 2xl:text-4xl font-heading">Lorem ipsum dolor sit amet consectetur adipiscing elit</h5>
          </div>

          <x-button
            :type="'link'"
            :color="''"
            :ring="false"
            :size="'lg'"
            :effects="['text']"
            href="https://www.facebook.com/edcampua"
            class="!p-0 order-3 md:justify-start"
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
      </div>
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute left-4 -bottom-2 z-0 max-w-[50%]">
  </section>

  {{-- E-Catalogue --}}
  <section class="relative pt-24 pb-24 overflow-hidden">
    {{-- container --}}
    <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
      {{-- Heading --}}
      <div class="mb-8 text-center md:mb-16 lg:pt-16 font-heading">
        <div class="text-xl text-[#222] mb-2 tracking-wide 2xl:text-3xl">Katalog</div>
        <h2 class="text-2xl xl:text-4xl font-bold text-[#222] mb-4 2xl:text-6xl">Produk-produk kami</h2>
        <p class="inline-flex max-w-4xl font-sans text-xl md:text-2xl">Kami menyediakan berbagai macam produk unggulan yang dapat anda pilih sesuai dengan kebutuhan anda.</p>
      </div>

      {{-- Iframe --}}
      <div class="lg:px-40">
        <div class="relative z-10 p-8 rounded-tl-[40px] rounded-br-[40px] overflow-hidden bg-[#f5f7fd]">
          <div class="aspect-w-16 aspect-h-9 rounded-tl-[40px] rounded-br-[40px] overflow-hidden">
            <iframe src="https://online.flippingbook.com/view/1014184528/1/" frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>

    {{-- Background --}}
    <img src="{{ asset('bg-dots-left.svg') }}" class="absolute right-0 lg:top-60 z-0 max-w-[50%]">
  </section>

  {{-- Contact Us --}}
  <section class="relative pt-24 pb-24 overflow-hidden bg-[#f9fafc]">
    {{-- container --}}
    <div class="relative z-10 md:px-5 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
      <div class="bg-[#006ce2] py-20 px-4 md:p-12 lg:p-16 md:rounded-3xl lg:rounded-[40px] grid lg:grid-cols-2 gap-10">
        {{-- Left - Heading --}}
        <div class="text-white font-heading">
          <div class="mb-4 text-xl tracking-wide 2xl:text-3xl">Hubungi Kami</div>
          <h2 class="mb-4 text-3xl md:text-5xl font-bold 2xl:text-6xl">Dapatkan informasi lebih lanjut melalui media sosial WhatsApp.</h2>
        </div>

        {{-- Right --}}
        <div>
          {{-- Form --}}
          <form class="space-y-8">
            {{-- Name --}}
            <div class="flex flex-col space-y-2">
              <label for="name" class="text-lg font-semibold text-white font-heading">Nama</label>
              <input type="text" id="name" class="w-full px-6 py-4 text-lg rounded-full shadow outline-none focus:shadow-inner" placeholder="Nama">
            </div>

            {{-- Topic --}}
            <div class="flex flex-col space-y-2">
              <label for="topic" class="text-lg font-semibold text-white font-heading">Topik</label>
              <input type="text" id="topic" class="w-full px-6 py-4 text-lg rounded-full shadow outline-none focus:shadow-inner" placeholder="Topik">
            </div>

            {{-- Message --}}
            <div class="flex flex-col space-y-2">
              <label for="message" class="text-lg font-semibold text-white font-heading">Pesan</label>
              <textarea id="message" class="w-full px-6 py-4 text-lg shadow outline-none rounded-2xl focus:shadow-inner" placeholder="Pesan" rows="4"></textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full py-4 px-6 rounded-full shadow text-lg outline-none focus:shadow-inner bg-[#ff5729] text-white font-semibold uppercase tracking-wider">Kirim</button>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
