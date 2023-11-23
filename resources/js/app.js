import './bootstrap';
import.meta.glob([
    '../img/**',
    '../fonts/**',
]);

/** Libraries */
import AsyncAlpine from 'async-alpine';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import LocomotiveScroll from 'locomotive-scroll';

/** Components */
import AlpineNavigationComponent from './components/navigation';

/** Directives */
import AlpineClassInitDirective from './directives/x-class-init';

/** Plugins */
import AlpineIntersect from '@alpinejs/intersect'

/** Register plugins */
Alpine.plugin(AlpineIntersect);

/** Register directives */
Alpine.directive('class-init', AlpineClassInitDirective);

document.addEventListener('alpine:init', () => {
    Alpine.data('navigation', AlpineNavigationComponent);

    const locomotiveScroll = new LocomotiveScroll();
});

AsyncAlpine
    .init(Alpine)
    .data('carousel', () => import('./components/carousel'))
    .data('iframe', () => import('./components/iframe'))
    .data('gallery', () => import('./components/gallery'))
    .data('contactForm', () => import('./components/contactForm'))
    .start();

Livewire.start();
