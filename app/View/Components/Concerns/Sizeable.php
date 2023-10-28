<?php

namespace App\View\Components\Concerns;

trait Sizeable
{
    public function size(?string $size)
    {
        if (!$size) {
            return '';
        }

        return match ($size) {
            'sm' => 'w-4 h-4',
            'md' => 'w-6 h-6',
            'lg' => 'w-10 h-10',
            'responsive' => 'w-4 h-4 sm:w-6 sm:h-6 md:w-10 md:h-10',
        } . ' ';
    }
}
