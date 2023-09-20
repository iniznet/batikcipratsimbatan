import Swiper from "swiper";
import { Pagination, EffectFade, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

export default (opts = {}) => ({
    instance: null,

    init() {
        const options = {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 1000,
            },
            slidesPerView: 'auto',
            pagination: {
                el: '.swiper-pagination'
            },
            modules: [Pagination, EffectFade, Autoplay],
            ...opts
        };

        this.instance = new Swiper(this.$el, options);
    },

    destroy() {
        this.instance.destroy();
    }
});
