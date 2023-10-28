<?php

namespace App\View\Components\Concerns;

trait Backgroundable
{
    public function background(?string $color)
    {
        if (empty($color)) {
            return '';
        }

        return match ($color) {
            'primary' => 'text-white bg-[#ff5729] focus:ring-orange-500',
            'secondary' => 'text-white bg-blue-600 focus:ring-blue-500',
            'tertiary' => 'text-[#222] bg-[#f5f7fd]',
            'transparent' => 'text-black bg-[#f9fafc] focus:ring-blue-500',
        } . ' ';
    }
}
