export default () => ({
    shown: false,
    height: 0,
    rootMargin: 30,

    init() {
        this.height = this.$el.offsetHeight + this.rootMargin;

        this.$watch('shown', (value) => {
            this.$dispatch('toggle-nav', value);
        });

        this.scroll();
    },

    scroll() {
        this.shown = window.scrollY > this.height;
    }
});
