<div class="grid gap-4 p-8 text-white bg-blue-600 md:p-12 rounded-3xl grid-areas-newsletter grid-cols-newsletter lg:grid-areas-newsletter__dekstop lg:grid-cols-newsletter__dekstop">
  <div class="grid-in-icon">
    <x-lucide
      :color="'secondary'"
      :size="'lg'"
      :shape="'circle'"
      class="bg-white xl:p-6"
    >
      <x-lucide-mail class="w-10 h-10 text-[#222]" />
    </x-lucide>
  </div>

  <div class="self-center grid-in-title">
    <h4 class="text-3xl font-semibold font-heading">Nawala Kami</h4>
  </div>

  <div class="max-w-xl text-2xl grid-in-message">
    <p>Berlangganan nawala kami untuk mendapatkan informasi terbaru dari kami.</p>
  </div>

  <div class="text-2xl grid-in-form">
    <h4 class="mb-4 text-3xl font-semibold font-heading">Masukkan Email</h4>

    <form
      class="relative"
      wire:submit="save"
    >
      <input type="email" class="text-[#222] w-full py-6 pl-8 pr-20 mb-4 rounded-full shadow outline-none focus:shadow-inner xl:m-0" placeholder="Email" wire:model="email" required>
      <button
        type="submit"
        class="xl:absolute font-semibold right-0 h-full z-10 px-10 py-4 text-white rounded-full bg-[#ff5729] uppercase tracking-wider"
      >
        <div wire:loading>
          <x-loading class="!text-white" />
        </div>
        <div wire:loading.remove>
          <span>Berlanggan</span>
        </div>
      </button>
    </form>

    <div class="mt-2 text-sm lg:text-base">
      <p>Dengan berlangganan, Anda menyetujui Kebijakan Privasi kami.</p>
    </div>

    {{-- Success message --}}
    @if ($subscribed)
      <div class="p-4 mt-4 text-sm text-white bg-green-500 lg:text-base rounded-xl 2xl:text-xl">
        <p>Terima kasih telah berlangganan!</p>
      </div>
    @endif
  </div>
</div>
