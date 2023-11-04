<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PageRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class SingleController extends Controller
{
    #[Route('/blog', name: 'blog.home', methods: ['GET'])]
    public function index(PostRepository $postRepository)
    {
        $post = $postRepository->getLatest();
        $posts = $postRepository->paginate(10);

        return view('blog', compact('post', 'posts'));
    }

    #[Route('/blog/{slug}', name: 'blog.detail', methods: ['GET'])]
    public function post(PostRepository $postRepository, string $slug)
    {
        $post = $postRepository->getBySlug($slug);
        $relatedPosts = $postRepository->getRelateds($post);

        return view('single', compact('post', 'relatedPosts'));
    }

    #[Route('/{slug}', name: 'page.detail', methods: ['GET'])]
    public function page(PageRepository $pageRepository, string $slug)
    {
        $post = $pageRepository->getBySlug($slug);
        return view('single', compact('post'));
    }
}
