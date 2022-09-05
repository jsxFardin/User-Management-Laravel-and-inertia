import "./bootstrap";
import jQuery from "jquery";
global.jQuery = jQuery;
global.$ = jQuery; //tested
import "./adminlte.min.js";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(fas);

import Multiselect from '@vueform/multiselect';
import "@vueform/multiselect/themes/default.css";
import Toast, { useToast } from "vue-toastification";
import "vue-toastification/dist/index.css";
import axios from "axios";
import QrcodeVue from "qrcode.vue";
import print from 'vue3-print-nb';

import { store } from "@/Store/Index"

import VueFullscreen from 'vue-fullscreen'


const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Digitized Operation";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        let page = (await import(`./Pages/${name}`)).default;

        return page;
    },
    setup({ el, app, props, plugin }) {
        const appCreate = createApp({ render: () => h(app, props) });

        appCreate.use(Toast); //tested
        appCreate.use(store); //tested
        const _toast = useToast();
        window.toast = _toast //tested
        window.axios = axios //tested
        window.storeData = store
        axios.defaults.baseURL = process.env.MIX_APP_URL
        appCreate.component("font-awesome-icon", FontAwesomeIcon); //tested
        appCreate.component("multi-select", Multiselect) //tested
        appCreate.component('qrcode-vue', QrcodeVue) //tested
        appCreate.use(plugin);
        appCreate.use(VueFullscreen)
        appCreate.mixin({ methods: { route } });
        appCreate.mixin(require("./translation")); // Translation
        appCreate.use(print) //tested

        appCreate.mount(el);
        return appCreate;
    },
});

InertiaProgress.init({ color: "#4B5563" });
