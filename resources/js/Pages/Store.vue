<script setup lang="ts">
import '@css/webapp.scss';
import {BackButton} from "vue-tg";
import {onMounted, ref, watch} from "vue";
import route from "ziggy-js";
import Pack from "@/Types/Pack";
import StorePack from "@/Components/StorePack.vue";
import {loadLanguageAsync} from 'laravel-vue-i18n';
import axios from "axios";
import User from "@/Types/User";
import WebApp from '@twa-dev/sdk';

interface Props {
    initData: string;
}
const props = defineProps<Props>();

const packs = ref<Pack[]>([]);
const user = ref<User>(null);

const goBack = () => window.history.back();

const setScheme = function () {
    if (WebApp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', WebApp.colorScheme);
    }
}

const loadTrendingPacks = async () => {
    const response = await axios.get(route('webapp.packs.trending', {
        initData: props.initData,
    }));
    packs.value = response.data;
};

const loadUser = async () => {
    try {
        const response = await axios.get(route('webapp.user'), {
            params: {
                initData: props.initData,
            },
        });
        user.value = response.data;
    } catch (e) {
    }
};

watch(user, (newUser) => {
    if (newUser) {
        loadLanguageAsync(newUser.language ?? 'en');
    }
});

onMounted(async () => {
    await loadUser();
    await loadTrendingPacks();
    setScheme();
    WebApp.setHeaderColor('#056104');
    WebApp.onEvent('themeChanged', () => setScheme());
    WebApp.expand();
    WebApp.ready();
});

</script>

<template>
    <BackButton :visible="true" @click="goBack"/>
    <StorePack v-for="pack in packs" :key="pack.id" :pack="pack" :init-data="props.initData"/>
</template>

<style scoped lang="scss">

</style>
