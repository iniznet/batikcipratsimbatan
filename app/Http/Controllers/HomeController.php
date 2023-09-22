<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

class HomeController extends Controller
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(Request $request)
    {
        return view('home');
    }
}
