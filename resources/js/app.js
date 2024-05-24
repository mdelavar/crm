import './bootstrap';
import '../css/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import permissionMixin from "@/mixins/permissionMixin.js";
import Axios from "@/axios.js";
import VueAxios from "vue-axios";
import ButtonWithLoading from './Components/button-with-loading/Main.vue';
import LoadingIcon from './Components/loading-icon/Main.vue';
import Tippy from './Components/tippy/Main.vue';
import TailSelect from './Components/tail-select/Main.vue';
import VueFeather from 'vue-feather';
import VuePersianDatetimePicker from "./Components/date-picker/VuePersianDatetimePicker.vue";
import $ from "cash-dom";

const appName = 'نرم افزار مدیریت ارتباط با مشتری';
window.cash = $;

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {

        const application = createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue, Ziggy);

        application.mixin(permissionMixin);
        application.use(VueAxios, Axios);

        application.component('ButtonWithLoading', ButtonWithLoading);
        application.component('LoadingIcon', LoadingIcon);
        application.component('Tippy', Tippy);
        application.component(VueFeather.name, VueFeather);
        application.component("VuePersianDatetimePicker", VuePersianDatetimePicker);
        application.component("TailSelect", TailSelect);

        application.mount(el);
        delete el.dataset.page
        return application;

    },
    progress: {
        color: '#4B5563',
    },
});
