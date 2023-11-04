import './bootstrap';
import.meta.glob([
    '../img/**',
    '../fonts/**',
]);

import AsyncAlpine from 'async-alpine';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

import AlpineNavigationComponent from './components/navigation';

import AlpineClassInitDirective from './directives/x-class-init';

Alpine.directive('class-init', AlpineClassInitDirective);

document.addEventListener('alpine:init', () => {
    Alpine.data('navigation', AlpineNavigationComponent);
});

AsyncAlpine
    .init(Alpine)
    .data('carousel', () => import('./components/carousel'))
    .data('iframe', () => import('./components/iframe'))
    .data('gallery', () => import('./components/gallery'))
    .start();

Livewire.start();
