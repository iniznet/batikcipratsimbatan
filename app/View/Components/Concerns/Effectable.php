<?php

namespace App\View\Components\Concerns;

trait Effectable
{
    public function effect(?string $type, string $color, bool $isGroup = false)
    {
        $class = match ($type) {
            'background' => match ($color) {
                'primary' => 'hover:bg-orange-700 hover:text-white', // group-hover:bg-orange-700 group-hover:text-white
                'secondary' => 'hover:bg-blue-700 hover:text-white', // group-hover:bg-blue-700 group-hover:text-white
                'transparent' => 'hover:bg-blue-700 hover:text-white', // group-hover:bg-blue-700 group-hover:text-white
                default => '',
            },
            'opacity' => 'opacity-75 md:opacity-50 hover:opacity-100', // group-hover:opacity-100
            'text' => match ($color) {
                'primary' => 'hover:text-orange-700', // group-hover:text-orange-700
                'secondary' => 'hover:text-blue-700', // group-hover:text-blue-700
                'transparent' => 'hover:text-blue-700', // group-hover:text-blue-700
                default => 'hover:text-orange-700', // group-hover:text-orange-700
            },
            'scale-in' => 'active:scale-90', // group-active:scale-90
            'scale-out' => 'active:scale-110', // group-active:scale-110
            default => '',
        } . ' ';

        if ($isGroup) {
            $class = str_replace('hover:', 'group-hover:', $class);
            $class = str_replace('active:', 'group-active:', $class);
        }

        return $class;
    }
}
