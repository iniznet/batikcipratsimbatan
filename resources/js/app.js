import './bootstrap';
import.meta.glob([
    '../img/**',
    '../fonts/**',
]);

import AsyncAlpine from 'async-alpine';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

import AlpineNavigationComponent from './components/navigation';

document.addEventListener('alpine:init', () => {
    Alpine.data('navigation', AlpineNavigationComponent);
});

AsyncAlpine
    .init(Alpine)
    .data('carousel', () => import('./components/carousel'))
    .start();

Livewire.start();
