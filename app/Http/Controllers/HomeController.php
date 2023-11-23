<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\HomeSettingsRepository;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]
class HomeController extends Controller
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(
        HomeSettingsRepository $homeSettingsRepository,
        PostRepository $postRepository
    )
    {
        $featureds = $homeSettingsRepository->getFeatureds();
        $aboutImage = $homeSettingsRepository->getAboutImage();

        $post = $postRepository->getLatest();
        $posts = $postRepository->get(2);

        $openingMessage = __('Halo, saya');
        $topicMessage = __('Saya ingin bertanya tentang');
        $closingMessage = __('Terima kasih.');
        $phones = config('settings.whatsapp_numbers', []);
        $phone = $phones[0]['phone'] ?? null;

        return view('home', [
            'featureds' => $featureds,
            'aboutImage' => $aboutImage,
            'post' => $post,
            'posts' => $posts,
            'openingMessage' => $openingMessage,
            'topicMessage' => $topicMessage,
            'closingMessage' => $closingMessage,
            'phone' => $phone,
        ]);
    }
}
