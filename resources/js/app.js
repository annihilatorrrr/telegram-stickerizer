import './bootstrap';
import {createApp} from 'vue';
import Stickerizer from "@/WebApps/Stickerizer.vue";
import AddStickers from "@/WebApps/AddStickers.vue";
import {library} from '@fortawesome/fontawesome-svg-core';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {faCircleNotch, faXmark} from '@fortawesome/free-solid-svg-icons';
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

library.add(faCircleNotch);
library.add(faCircleQuestion);
library.add(faClock);
library.add(faXmark);
library.add(faStar);
library.add(faPaperPlane);
library.add(faTrashCan);
library.add(faFaceSadTear);

if (document.getElementById('app')){
    createApp(Stickerizer)
        .component('font-awesome-icon', FontAwesomeIcon)
        .use(i18nVue, {
            resolve: async lang => {
                const langs = import.meta.glob('../../lang/*.json');
                return await langs[`../../lang/${lang}.json`]();
            }
        })
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
        .mount('#app-addstickers');
}
