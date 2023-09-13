<script setup lang="ts">
import {BackButton} from "vue-tg";
import {onMounted, ref} from "vue";
import route from "ziggy-js";
import Pack from "@/Types/Pack";
import StorePack from "@/Components/StorePack.vue";
import {loadLanguageAsync} from 'laravel-vue-i18n';
import axios from "axios";

const packs = ref<Pack[]>([]);

const goBack = () => window.history.back();

const loadTrendingPacks = async () => {
    const response = await axios.get(route('webapp.packs.trending', {
        user_id: window.initData.user_id,
        fingerprint: window.initData.fingerprint,
    }));
    packs.value = response.data;
};

onMounted(() => {
    loadLanguageAsync(window.initData.lang ?? 'en');
    loadTrendingPacks();
});

</script>

<template>
    <BackButton :visible="true" @click="goBack"/>
    <StorePack v-for="pack in packs" :key="pack.id" :pack="pack"/>
</template>

<style scoped lang="scss">

</style>
