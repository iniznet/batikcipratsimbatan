<?php

namespace App\Livewire;

use App\Livewire\Concerns\SortType;
use App\Models\Shop\Product;
use App\Models\Shop\ShopCategory;
use App\Models\Shop\ShopMaterial;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Catalog extends Component
{
    use WithPagination;

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
    public int $maxPrice = 1000000;

    #[Url(as: 'sort', history: true)]
    public string $selectedSortType;

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatingSelectedMaterials()
    {
        $this->resetPage();
    }

    public function updatingSortType()
    {
        $this->resetPage();
    }

    public function updatingMinPrice()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = ShopCategory::all();
        $materials = ShopMaterial::all();

        $sortTypes = collect([
            SortType::NEWEST,
            SortType::OLDEST,
            SortType::PRICE_ASC,
            SortType::PRICE_DESC,
        ])->map(fn (SortType $sortType) => [
            'value' => $sortType->value,
            'label' => $sortType->label(),
        ])->toArray();
        $this->selectedSortType = $this->selectedSortType ?? SortType::NEWEST->value;

        $products = Product::query()
            ->when($this->query, fn ($query) => $query->where('title', 'like', "%{$this->query}%"))
            ->when($this->selectedCategories, fn ($query) => $query->whereHas('category', fn ($query) => $query->whereIn('id', $this->selectedCategories)))
            ->when($this->selectedMaterials, fn ($query) => $query->whereHas('material', fn ($query) => $query->whereIn('id', $this->selectedMaterials)))
            ->when($this->minPrice, fn ($query) => $query->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn ($query) => $query->where('price', '<=', $this->maxPrice))
            ->when($this->selectedSortType, fn ($query) => match ($this->selectedSortType) {
                SortType::NEWEST->value => $query->orderByDesc('created_at'),
                SortType::OLDEST->value => $query->orderBy('created_at'),
                SortType::PRICE_ASC->value => $query->orderBy('price'),
                SortType::PRICE_DESC->value => $query->orderByDesc('price'),
            })
            ->cursorPaginate(10);

        $this->maxPrice = $products->isNotEmpty() ? Product::all()->max('price') : $this->maxPrice;

        return view('livewire.catalog', compact('products', 'categories', 'materials', 'sortTypes'));
    }
}
