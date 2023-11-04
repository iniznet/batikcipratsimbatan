<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class HomeController extends Controller
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(PostRepository $postRepository)
    {
        $post = $postRepository->getLatest();
        $posts = $postRepository->get(2);

        return view('home', compact('post', 'posts'));
    }
}
