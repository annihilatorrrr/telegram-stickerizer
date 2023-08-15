import './bootstrap';
import {createApp} from 'vue';
import Main from "@/webapp/Main.vue";
import {library} from '@fortawesome/fontawesome-svg-core';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {faCircleNotch, faXmark} from '@fortawesome/free-solid-svg-icons';
import {faCircleQuestion, faClock} from '@fortawesome/free-regular-svg-icons';
import "vue-progressive-image/dist/style.css";
import {i18nVue} from 'laravel-vue-i18n';

library.add(faCircleNotch);
library.add(faCircleQuestion);
library.add(faClock);
library.add(faXmark);

createApp(Main)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(i18nVue, {
        resolve: async lang => {
            const langs = import.meta.glob('../../lang/*.json');
            return await langs[`../../lang/${lang}.json`]();
        }
    })
    .mount('#app');
