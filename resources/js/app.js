import './bootstrap';
import {createApp} from 'vue';
import Stickerizer from "@/WebApps/Stickerizer.vue";
import AddStickers from "@/WebApps/AddStickers.vue";
import Store from "@/WebApps/Store.vue";
import {library} from '@fortawesome/fontawesome-svg-core';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {faBoxesStacked, faCircleNotch, faMagnifyingGlass, faXmark, faEllipsisVertical, faShare, faLink} from '@fortawesome/free-solid-svg-icons';
import {
    faCircleQuestion,
    faClock,
    faFaceSadTear,
    faPaperPlane,
    faStar,
    faTrashCan
} from '@fortawesome/free-regular-svg-icons';
import "vue-progressive-image/dist/style.css";
import {i18nVue} from 'laravel-vue-i18n';
import '@imengyu/vue3-context-menu/lib/vue3-context-menu.css'
import ContextMenu from '@imengyu/vue3-context-menu'

library.add(faCircleNotch);
library.add(faCircleQuestion);
library.add(faClock);
library.add(faXmark);
library.add(faStar);
library.add(faPaperPlane);
library.add(faTrashCan);
library.add(faFaceSadTear);
library.add(faMagnifyingGlass);
library.add(faBoxesStacked);
library.add(faEllipsisVertical);
library.add(faShare);
library.add(faLink);

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
