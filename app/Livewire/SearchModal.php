<?php

namespace App\Livewire;

use App\Models\Blog\Post;
use App\Models\Shop\Product;
use App\Repositories\Contracts\PageRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\ProductRepository;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchModal extends Component
{
    public string $searchQuery = '';

    public function render(
        PostRepository $postRepository,
        PageRepository $pageRepository,
        ProductRepository $productRepository,
    ) {
        $results = collect();

        if (strlen($this->searchQuery) >= 3) {
            $results = $results->merge($postRepository->search($this->searchQuery));
            $results = $results->merge($pageRepository->search($this->searchQuery));
            $results = $results->merge($productRepository->search($this->searchQuery));
        }

        // change to respective route
        $results = $results->map(function ($result) {
            if ($result instanceof Product) {
                $result->url = route('product.detail', $result->slug);
            } else if ($result instanceof Post) {
                $result->url = route('blog.detail', $result->slug);
            } else {
                $result->url = route('page.detail', $result->slug);
            }

            return $result;
        });

        return view('livewire.search-modal', [
            'results' => $results,
        ]);
    }
}
