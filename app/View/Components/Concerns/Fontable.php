<?php

namespace App\View\Components\Concerns;

trait Fontable
{
    public function fontSize(string $size)
    {
        return match ($size) {
            'sm' => 'text-sm',
            'md' => 'text-base',
            'lg' => 'text-xl',
        } . ' ';
    }
}
