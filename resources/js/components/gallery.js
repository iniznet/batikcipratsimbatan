import Swiper from "swiper";
import { EffectFade, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/effect-fade';

export default (opts = {}, thumbOpts = {}) => ({
    featuredInstance: null,
    thumbInstance: null,

    init() {
        const thumbInstanceOpts = {
            loop: true,
            spaceBetween: 12,
            slidesPerView: 4,
            freeMode: true,
            watchSliderProgress: true,
            ...thumbOpts
        };
        this.thumbInstance = new Swiper(this.$refs.thumbsEl, thumbInstanceOpts);

        const featuredInstanceOpts = {
            loop: true,
            spaceBetween: 12,
            slidesPerView: 'auto',
            modules: [EffectFade, Thumbs],
            thumbs: {
                swiper: this.thumbInstance,
                slideThumbActiveClass: '!opacity-100',
            },
            ...opts
        };

        this.featuredInstance = new Swiper(this.$refs.featuredEl, featuredInstanceOpts);
    },

    destroy() {
        this.featuredInstance.destroy();
        this.thumbInstance.destroy();
    }
});
