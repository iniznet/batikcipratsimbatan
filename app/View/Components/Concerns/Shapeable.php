<?php

namespace App\View\Components\Concerns;

trait Shapeable
{
    public function shape(string $shape)
    {
        return match ($shape) {
            'rounded' => 'rounded-md',
            'circle' => 'rounded-full',
            'square' => 'rounded-none',
        } . ' ';
    }
}
