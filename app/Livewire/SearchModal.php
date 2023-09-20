<?php

namespace App\Livewire;

use App\Models\Shop\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchModal extends Component
{
    public string $query = '';

    public function render()
    {
        $products = $this->query
            ? Product::where('title', 'like', "%{$this->query}%")->get()
            : [];

        return view('livewire.search-modal', [
            'products' => $products,
        ]);
    }
}
