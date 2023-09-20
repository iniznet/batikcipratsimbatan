<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class ShopController extends Controller
{
    #[Route('/product', name: 'product.home', methods: ['GET'])]
    public function detail(Request $request)
    {
        return view('product');
    }
}
