<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

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
        $this->subscribed = true;
    }
}
