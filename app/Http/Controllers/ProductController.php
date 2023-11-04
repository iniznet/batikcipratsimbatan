<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepository;
use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class ProductController extends Controller
{
    #[Route('/produk/{slug}', name: 'product.detail', methods: ['GET'])]
    public function detail(ProductRepository $productRepository, string $slug)
    {
        $product = $productRepository->getBySlug($slug);
        $relatedProducts = $productRepository->getRelateds($product);

        return view('product', compact('product', 'relatedProducts'));
    }
}
