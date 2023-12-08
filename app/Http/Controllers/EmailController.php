<?php

namespace App\Http\Controllers;

use App\Models\Management\Subscriber;
use Illuminate\Http\Request;
use SmashedEgg\LaravelRouteAnnotation\Route;

#[Route(middleware: ['web'])]

class EmailController extends Controller
{
    // Unsubscribe from newsletter
    #[Route('/newsletter/unsubscribe/{email}/{token}', name: 'newsletter.unsubscribe', methods: ['GET'])]
    public function unsubscribe(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        $subscriber = Subscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->token == $token) {
            $subscriber->active = false;
            $subscriber->save();
        }

        return redirect()->route('home');
    }
}
