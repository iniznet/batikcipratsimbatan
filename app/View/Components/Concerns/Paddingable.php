<?php

namespace App\View\Components\Concerns;

trait Paddingable
{
    public function padding(string $padding)
    {
        return match ($padding) {
            'sm' => 'px-3 py-1',
            'md' => 'px-2 py-2',
            'lg' => 'px-4 py-4',
            'responsive' => 'px-3 py-1 sm:px-2 sm:py-2 md:px-4 md:py-4',
            default => '',
        } . ' ';
    }
}
