import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

export default () => ({
    init() {
        Fancybox.bind('[data-fancybox]', {})
    }
});
