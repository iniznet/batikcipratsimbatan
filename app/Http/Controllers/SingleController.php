<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class SingleController extends Controller
{
    #[Route('/blog', name: 'blog.home', methods: ['GET'])]
    public function list(Request $request)
    {
        return view('blog');
    }
}
