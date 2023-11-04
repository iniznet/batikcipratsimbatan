<footer class="relative bg-[#f5f7fd] pt-16 pb-9">
  {{-- Container --}}
  <div class="relative z-10 px-5 md:px-8 lg:px-10 max-w-[1440px] xl:px-24 2xl:max-w-full mx-auto">
    {{-- Content --}}
    <div class="grid-cols-7 space-y-4 lg:grid">
      {{-- Left --}}
      <div class="relative col-span-3 pr-8 space-y-4">
        {{-- Logo --}}
        <div
          x-data
          x-class-init.delay.1000.hold.2000="'scale-110'"
          class="inline-flex justify-start transition duration-1000 font-title place-self-start hover:scale-110"
          >
          <a href="/" class="text-center">
            <span class="block text-3xl font-semibold leading-normal lg:text-4xl">Batik Ciprat</span>
            <span class="block -mt-4 text-2xl font-light leading-normal">Langitan</span>
          </a>
        </div>

        {{-- Tagline --}}
        <div class="text-xl">
          <p>Batik Ciprat Langitan Simbatan — adalah sebuah komunitas yang bergerak di bidang batik diperuntukkan bagi masyarakat difabel.</p>
        </div>
      </div>

      {{-- Right --}}
      <div class="col-start-4 col-end-8 space-y-4">
        {{-- Footer Navigation --}}
        <div class="grid pb-6 gap-y-4 md:grid-cols-2">
          {{-- Left --}}
          <div class="text-xl">
            <div class="mb-4 font-semibold">Navigasi</div>
            <ul class="flex flex-col space-y-2">
              <li>
                <a href="/">Beranda</a>
              </li>
              <li>
                <a href="/blog">Blog</a>
              </li>
              <li>
                <a href="/katalog">Katalog</a>
              </li>
            </ul>
          </div>

          {{-- Right --}}
          <div class="text-xl">
            <div class="mb-4 font-semibold">Lainnya</div>
            <ul class="flex flex-col space-y-2">
              <li>
                <a href="/page/tentang-kami">Tentang Kami</a>
              </li>
              <li>
                <a href="/page/kebijakan-privasi">Kebijakan Privasi</a>
              </li>
              <li>
                <a href="/page/faq">FAQ</a>
              </li>
            </ul>
          </div>
        </div>

        {{-- Copyright & Credit --}}
        <div class="grid md:grid-cols-2 pt-6 border-t border-t-[#a5b5e6]">
          {{-- Left --}}
          <div>@ 2023 Batik Ciprat Langitan Simbatan.<br> All Rights Reserved.</div>

          {{-- Right --}}
          <div>Dikembangkan oleh <a href="https://github.com/iniznet/" target="_blank" rel="noopener noreferrer">Tim PPK Deptics 2023</a></div>
        </div>
      </div>
    </div>
  </div>
</footer>

@push('scripts')
  {{-- Load FancyBox --}}
  <div
    x-ignore
    ax-load
    x-data="iframe"
    x-init="$el.remove()"
  ></div>

  @if (config("settings.google_analytics_id"))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('settings.google_analytics_id') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ config("settings.google_analytics_id") }}');
    </script>
  @endif
@endpush
