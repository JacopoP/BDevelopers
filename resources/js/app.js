import './bootstrap';
// import '../css/app.css';
import '~resources/sass/general.scss';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import { library } from '@fortawesome/fontawesome-svg-core';
import { faGithub } from '@fortawesome/free-brands-svg-icons';
import { faEye, faEyeSlash, faStar, faStarHalfStroke, faPencil, faPhone, faEnvelope } from '@fortawesome/free-solid-svg-icons';
import { faStar as starEmpty, faCopy, faCopyright } from '@fortawesome/free-regular-svg-icons';
library.add(faEye, faEyeSlash, faStar, starEmpty, faStarHalfStroke, faPencil, faCopy, faCopyright, faGithub, faPhone, faEnvelope);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();

// const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} | BDevelopers`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
