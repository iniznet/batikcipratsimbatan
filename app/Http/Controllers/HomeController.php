<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class HomeController extends Controller
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index()
    {
        return view('home');
    }
}
