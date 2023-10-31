@if (!isset($reverse) || !$reverse)
  {{-- Card --}}
  <div class="grid gap-8 p-8 shadow-lg rounded-tl-3xl rounded-br-3xl {{ isset($background) ? $background : 'bg-white' }}">
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
@else
  {{-- Card --}}
  <div class="grid gap-8 p-8 shadow-lg rounded-tl-3xl rounded-br-3xl {{ isset($background) ? $background : 'bg-white' }}">
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
@endif
