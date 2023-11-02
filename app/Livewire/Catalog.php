<?php

namespace App\Livewire;

use App\Livewire\Concerns\SortType;
use App\Models\Shop\Product;
use App\Models\Shop\ShopCategory;
use App\Models\Shop\ShopMaterial;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class Catalog extends Component
{
    /** @var \App\Models\Shop\Product[] */
    public Collection $products;

    /** @var \App\Models\Shop\ShopCategory[] */
    public Collection $categories;

    /** @var \App\Models\Shop\ShopMaterial[] */
    public Collection $materials;

    /** @var array */
    public array $sortTypes;

    #[Url(history: true)]
    public string $query = '';

    /** @var int[] */
    #[Url(as: 'cat', history: true)]
    public array $selectedCategories = [];

    /** @var int[] */
    #[Url(as: 'mat', history: true)]
    public array $selectedMaterials = [];

    #[Url(as: 'min', history: true)]
    public int $minPrice = 0;

    #[Url(as: 'max', history: true)]
    public int $maxPrice;

    #[Url(as: 'sort', history: true)]
    public string $selectedSortType;

    public function mount()
    {
        $this->products = $this->query ? $this->updatedQuery() : Product::all();
        $this->categories = $this->selectedCategories ? ShopCategory::whereIn('id', $this->selectedCategories)->get() : ShopCategory::all();
        $this->materials = $this->selectedMaterials ? ShopMaterial::whereIn('id', $this->selectedMaterials)->get() : ShopMaterial::all();

        $this->maxPrice = $this->products->isNotEmpty() ? $this->products->max('price') : 1000000;
        $this->sortTypes = collect([
            SortType::NEWEST,
            SortType::OLDEST,
            SortType::PRICE_ASC,
            SortType::PRICE_DESC,
        ])->map(fn ($sortType) => [
            'value' => $sortType->value,
            'label' => $sortType->label(),
        ])->toArray();
        $this->selectedSortType = $this->selectedSortType ?? SortType::NEWEST->value;
    }

    public function updatedQuery(): Collection
    {
        $this->products = Product::where('title', 'like', "%{$this->query}%")->get();
        return $this->products;
    }

    public function updatedSelectedCategories(): Collection
    {
        $this->products = $this->selectedCategories ? Product::whereHas('category', function ($query) {
            $query->whereIn('id', $this->selectedCategories);
        })->get() : Product::all();

        return $this->products;
    }

    public function updatedSelectedMaterials(): Collection
    {
        $this->products = $this->selectedMaterials ? Product::whereHas('materials', function ($query) {
            $query->whereIn('id', $this->selectedMaterials);
        })->get() : Product::all();

        return $this->products;
    }

    public function updatedSortType()
    {
        $this->products = match ($this->sortType) {
            SortType::NEWEST => Product::orderByDesc('created_at')->get(),
            SortType::OLDEST => Product::orderBy('created_at')->get(),
            SortType::PRICE_ASC => Product::orderBy('price')->get(),
            SortType::PRICE_DESC => Product::orderByDesc('price')->get(),
        };
    }

    public function updatedMinPrice()
    {
        $this->products = Product::where('price', '>=', $this->minPrice)->get();
    }

    public function updatedMaxPrice()
    {
        $this->products = Product::where('price', '<=', $this->maxPrice)->get();
    }

    public function render()
    {
        return view('livewire.catalog');
    }
}
