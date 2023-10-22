import './bootstrap';

// vue + inertia
import {createApp, h} from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// fontawesome
import {library} from '@fortawesome/fontawesome-svg-core';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import * as faSolidIcons from '@fortawesome/free-solid-svg-icons';
import * as faRegularIcons from '@fortawesome/free-regular-svg-icons';

// context menu
import '@imengyu/vue3-context-menu/lib/vue3-context-menu.css';
import ContextMenu from '@imengyu/vue3-context-menu';

// i18n
import {i18nVue} from 'laravel-vue-i18n';

// vue-progressive-image
import "vue-progressive-image/dist/style.css";

// load fontawesome icons
library.add(faSolidIcons.faCircleNotch);
library.add(faSolidIcons.faXmark);
library.add(faSolidIcons.faMagnifyingGlass);
library.add(faSolidIcons.faBoxesStacked);
library.add(faSolidIcons.faShare);
library.add(faSolidIcons.faEllipsisVertical);
library.add(faSolidIcons.faLink);
library.add(faSolidIcons.faCode);
library.add(faSolidIcons.faInfo);
library.add(faRegularIcons.faCircleQuestion);
library.add(faRegularIcons.faClock);
library.add(faRegularIcons.faStar);
library.add(faRegularIcons.faPaperPlane);
library.add(faRegularIcons.faTrashCan);
library.add(faRegularIcons.faFaceSadTear);

/*
import Stickerizer from "@/WebApps/Stickerizer.vue";
import AddStickers from "@/WebApps/AddStickers.vue";
import Store from "@/WebApps/Store.vue";

if (document.getElementById('app')){
    createApp(Stickerizer)
        .component('font-awesome-icon', FontAwesomeIcon)
        .use(i18nVue, {
            resolve: async lang => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            }
        })
        .use(ContextMenu)
        .mount('#app');
}

if (document.getElementById('app-addstickers')) {
    createApp(AddStickers)
        .component('font-awesome-icon', FontAwesomeIcon)
        .use(i18nVue, {
            resolve: async lang => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            }
        })
        .use(ContextMenu)
        .mount('#app-addstickers');
}

if (document.getElementById('app-store')) {
    createApp(Store)
        .component('font-awesome-icon', FontAwesomeIcon)
        .use(i18nVue, {
            resolve: async lang => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            }
        })
        .use(ContextMenu)
        .mount('#app-store');
}
*/

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(i18nVue, {
                resolve: async lang => {
                    const langs = import.meta.glob('../../lang/*.json');
                    return await langs[`../../lang/${lang}.json`]();
                }
            })
            .use(ContextMenu)
            .use(plugin)
            .mount(el)
    },
    progress: {
        color: '#056104',
    },
})
