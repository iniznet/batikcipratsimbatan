<?php

namespace App\Livewire\Concerns;

enum SortType: string
{
    case NEWEST = 'newest';
    case OLDEST = 'oldest';
    case PRICE_ASC = 'price_asc';
    case PRICE_DESC = 'price_desc';

    public function label(): string
    {
        return match ($this) {
            self::NEWEST => __('Newest'),
            self::OLDEST => __('Oldest'),
            self::PRICE_ASC => __('Lowest Price'),
            self::PRICE_DESC => __('Highest Price'),
        };
    }
}
