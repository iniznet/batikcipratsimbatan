<?php

namespace App\View\Components;

use App\View\Components\Concerns\Backgroundable;
use App\View\Components\Concerns\Effectable;
use App\View\Components\Concerns\Paddingable;
use App\View\Components\Concerns\Shapeable;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lucide extends Component
{
    use Backgroundable, Effectable, Paddingable, Shapeable;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $color = '', // primary, secondary, transparent, null
        public ?string $size = '', // sm, md, lg
        public string $shape = 'circle', // rounded, circle, square
        public string|array|null $effects = null, // background, scale-in/out, null
        public string $classes = ' flex items-center justify-center font-medium',
    )
    {
        $this->classes .= $effects ? ' transition duration-300 ease-in-out ' : '';

        $effects = !is_array($effects) ? [$effects] : $effects;

        $this->classes .= $this->background($this->color);
        $this->classes .= $this->padding($this->size);
        $this->classes .= $this->shape($this->shape);

        foreach ($effects as $effect) {
            $this->classes .= $this->effect($effect, $this->color, true);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.lucide');
    }
}
