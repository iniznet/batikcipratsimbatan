<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class SingleController extends Controller
{
    #[Route('/blog', name: 'blog.home', methods: ['GET'])]
    public function list()
    {
        return view('blog');
    }

    #[Route('/blog/{slug}', name: 'blog.detail', methods: ['GET'])]
    public function detail()
    {
        return view('single');
    }

    #[Route('/{slug}', name: 'page.detail', methods: ['GET'])]
    public function page()
    {
        return view('single');
    }
}
