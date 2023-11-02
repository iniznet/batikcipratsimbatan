{{-- public string $query = '';

/** @var \App\Models\Shop\Product[] */
public Collection $products;

/** @var \App\Models\Shop\ShopCategory[] */
public Collection $categories;

/** @var \App\Models\Shop\ShopMaterial[] */
public Collection $materials;

/** @var int[] */
public array $selectedCategories = [];

/** @var int[] */
public array $selectedMaterials = [];

public float $minPrice = 0;

public float $maxPrice;

public array $sortTypes = [
    SortType::NEWEST,
    SortType::OLDEST,
    SortType::PRICE_ASC,
    SortType::PRICE_DESC,
];

public SortType $sortType = SortType::NEWEST; --}}
<div>
  {{-- Shop: two cols, left for sidebar as filters and right for query, sort types and product cards --}}
  <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
    {{-- Sidebar --}}
    <div class="hidden col-span-1 md:block">
      <div class="sticky top-0 space-y-8">
        {{-- Category Filter --}}
        <div class="space-y-4">
          <h5 class="text-lg font-semibold">Kategori</h5>
          {{-- List of Checkboxes --}}
          <div class="space-y-2">
            @foreach ($categories as $category)
              <x-checkbox
                :value="$category->id"
                :checked="in_array($category->id, $selectedCategories)"
                wire:model.live.debounce.500ms="selectedCategories"
              >{{ $category->name }}</x-checkbox>
            @endforeach
          </div>
        </div>

        {{-- Material Filter --}}
        <div class="space-y-4">
          <h5 class="text-lg font-semibold">Bahan</h5>
          {{-- List of Checkboxes --}}
          <div class="space-y-2">
            @foreach ($materials as $material)
              <x-checkbox
                :value="$material->id"
                :checked="in_array($material->id, $selectedMaterials)"
                wire:model.live.debounce.500ms="selectedMaterials"
              >{{ $material->name }}</x-checkbox>
            @endforeach
          </div>
        </div>

        {{-- Price Filter --}}
        <div class="space-y-4">
          <h5 class="text-lg font-semibold">Harga</h5>
          <div class="flex items-center space-x-4">
            <x-input
              :value="$minPrice"
              wire:model.live.debounce.500ms="minPrice"
              type="number"
            />
            <span>-</span>
            <x-input
              :value="$maxPrice"
              wire:model.live.debounce.500ms="maxPrice"
              type="number"
            />
          </div>
        </div>
      </div>
    </div>

    {{-- Right side --}}
    <div class="col-span-3">
      {{-- Query --}}
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center space-x-4">
          <x-input
            :searchIcon="true"
            :value="$query"
            wire:model.live.debounce.500ms="query"
            class="min-w-[12rem] px-10"
          >{{ __('Cari...') }}</x-input>
        </div>

        {{-- Sort Types --}}
        <div class="flex items-center space-x-4">
          <h5 class="text-lg font-semibold">Sortir</h5>
          <x-select
            :options="$sortTypes"
            :selected="$selectedSortType"
            wire:model.live="selectedSortType"
          />
        </div>
      </div>

      {{-- Product Cards --}}
      <div>
        {{-- Livewire loading --}}
        <div wire:loading class="w-full py-10">
          <div class="flex items-center justify-center">
            <x-loading />
          </div>
        </div>

        {{-- Livewire empty --}}
        <div wire:loading.remove class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
          @if ($products->isEmpty())
            <div class="flex justify-center col-span-full">
              <h5 class="text-lg font-semibold">Tidak ada produk yang ditemukan</h5>
            </div>
          @else
            @foreach ($products as $product)
              @include('partials.product-card', ['product' => $product])
            @endforeach
          @endif

          {{-- Pagination --}}
          <div class="col-span-full">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
