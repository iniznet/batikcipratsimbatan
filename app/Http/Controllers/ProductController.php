<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class ProductController extends Controller
{
    #[Route('/product/{slug}', name: 'product.detail', methods: ['GET'])]
    public function detail(Request $request)
    {
        return view('product');
    }
}
