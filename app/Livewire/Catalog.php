<?php

namespace App\Livewire;

use App\Repositories\Contracts\CatalogRepository;
use App\Repositories\Contracts\ShopCategoryRepository;
use App\Repositories\Contracts\ShopMaterialRepository;
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

    public function updatingMinPrice()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        $this->resetPage();
    }

    public function updatingSelectedSortType()
    {
        $this->resetPage();
    }

    public function mount()
    {

    }

    public function render(
        CatalogRepository $catalogRepository,
        ShopCategoryRepository $shopCategoryRepository,
        ShopMaterialRepository $shopMaterialRepository
    ) {
        $categories = $shopCategoryRepository->all();
        $materials = $shopMaterialRepository->all();

        $sortTypes = $catalogRepository->getSortTypes();
        $this->selectedSortType = $this->sortType ?? $sortTypes[0]['value'];

        $products = $catalogRepository->filter(
            $this->query,
            $this->selectedCategories,
            $this->selectedMaterials,
            $this->minPrice,
            $this->maxPrice,
            $this->selectedSortType,
        );

        return view('livewire.catalog', compact('products', 'categories', 'materials', 'sortTypes'));
    }
}
