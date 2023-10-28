<?php

namespace App\View\Components;

use App\View\Components\Concerns\Backgroundable;
use App\View\Components\Concerns\Effectable;
use App\View\Components\Concerns\Fontable;
use App\View\Components\Concerns\Paddingable;
use App\View\Components\Concerns\Shapeable;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    use Backgroundable, Fontable, Effectable, Paddingable, Shapeable;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'button', // button, submit, link, icon
        public ?string $color = 'primary', // primary, secondary, transparent, null
        public string $size = 'md', // sm, md, lg
        public false|string $padding = '', // sm, md, lg
        public string $shape = 'rounded', // rounded, circle, square
        public string $location = 'left', // left, right
        public string|array|null $effects = 'background', // background, scale-in/out, null
        public string $classes = '',
        public string $buttonSizeClasses = '',
        public bool $ring = true,
    )
    {
        $effects = !is_array($effects) ? [$effects] : $effects;

        $this->classes .= 'inline-flex items-center justify-center transition duration-300 ease-in-out group';

        if ($ring) {
            $this->classes .= ' focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-primary';
        }

        $this->classes .= $location === 'left' ? ' flex-row space-x-4 ' : ' flex-row-reverse space-x-4 ';

        $this->classes .= $this->background($this->color);
        $this->classes .= $this->padding($this->padding === false ? '' : ($this->padding ?: $this->size));
        $this->classes .= $this->shape($this->shape);
        $this->classes .= $this->fontSize($this->size);

        foreach ($effects as $effect) {
            $this->classes .= $this->effect($effect, $this->color);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
