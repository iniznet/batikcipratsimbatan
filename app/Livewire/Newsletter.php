<?php

namespace App\Livewire;

use App\Models\Management\Subscriber;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class Newsletter extends Component
{
    #[Validate('required|email')]
    public string $email = '';
    public bool $subscribed = false;

    public function render()
    {
        return view('livewire.newsletter');
    }

    public function save()
    {
        Subscriber::create([
            'email' => $this->email,
            'token' => Str::random(40),
            'active' => true,
        ]);

        $this->subscribed = true;
    }
}
