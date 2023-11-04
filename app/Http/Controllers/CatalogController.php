<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class CatalogController extends Controller
{
    #[Route('/katalog', name: 'catalog', methods: ['GET'])]
    public function index(Request $request)
    {
        return view('browse');
    }
}
