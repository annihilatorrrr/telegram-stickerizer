import './bootstrap';
import {createApp} from 'vue';
import Main from "@/webapp/Main.vue";
import {library} from '@fortawesome/fontawesome-svg-core';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import {faCircleNotch} from '@fortawesome/free-solid-svg-icons';

library.add(faCircleNotch);

createApp(Main)
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount('#app');
