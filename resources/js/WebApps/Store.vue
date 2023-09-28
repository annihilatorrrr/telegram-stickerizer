<script setup lang="ts">
import {BackButton} from "vue-tg";
import {onMounted, ref, watch} from "vue";
import route from "ziggy-js";
import Pack from "@/Types/Pack";
import StorePack from "@/Components/StorePack.vue";
import {loadLanguageAsync} from 'laravel-vue-i18n';
import axios from "axios";
import User from "@/Types/User";

const webapp = window.Telegram.WebApp;
const packs = ref<Pack[]>([]);
const user = ref<User>(null);

const goBack = () => window.history.back();

const setScheme = function () {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
}

const loadTrendingPacks = async () => {
    const response = await axios.get(route('webapp.packs.trending', {
        user_id: window.initData.user_id,
        fingerprint: window.initData.fingerprint,
    }));
    packs.value = response.data;
};

const loadUser = async () => {
    try {
        const response = await axios.get(route('webapp.user'), {
            params: {
                user_id: window.initData.user_id,
                fingerprint: window.initData.fingerprint,
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
    webapp.setHeaderColor('#056104');
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.expand();
    webapp.ready();
});

</script>

<template>
    <BackButton :visible="true" @click="goBack"/>
    <StorePack v-for="pack in packs" :key="pack.id" :pack="pack"/>
</template>

<style scoped lang="scss">

</style>
