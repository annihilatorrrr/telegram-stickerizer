<script setup lang="ts">
import {trans, trans_choice} from 'laravel-vue-i18n';
import Pack from "@/Types/Pack";
import BetterImage from "@/Components/BetterImage.vue";
import axios from "axios";
import route from "ziggy-js";
import { Link } from '@inertiajs/vue3';

interface Props {
    initData: string;
    pack: Pack;
}
const props = defineProps<Props>();

const addPack = async (packID: number) => {
    await axios.post(route('webapp.store.pack.add', {pack: packID}), {
        initData: props.initData,
    });
};

const removePack = async (packID: number) => {
    await axios.post(route('webapp.store.pack.remove', {pack: packID}), {
        initData: props.initData,
    });
};

const handlePack = async (pack: Pack) => {
    if (pack.installed) {
        await removePack(pack.id);
    } else {
        await addPack(pack.id);
    }
    pack.installed = !pack.installed;
};

</script>

<template>
    <div class="flex flex-col gap-1 p-2 border-tg-scheme border-b-[1px]">
        <div class="flex-1 flex gap-1 items-center">
            <div class="flex-1">
                <Link :href="route('webapp.addstickers', {initData: props.initData, packCode: pack.code, canGoBack: true})">
                <p class="font-bold">
                    {{ pack.name }}
                </p>
                </Link>
                <p class="text-tg-hint text-xs">
                    {{ trans_choice('webapp.sticker_count', pack.stickers_count) }} |
                    {{ trans_choice('common.install_count', pack.install_count) }}
                </p>
            </div>
            <p class="flex-none">
                <button class="packButton" :class="{'installed': pack.installed}" @click="() => handlePack(pack)">
                    <span v-if="pack.installed">{{ trans('common.remove') }}</span>
                    <span v-else>{{ trans('common.add') }}</span>
                </button>
            </p>
        </div>
        <div class="flex-none grid grid-cols-5 grid-rows-1 gap-2 pt-2">
            <div v-for="sticker in pack.stickers.slice(0,5)" :key="sticker.id">
                <Link :href="route('webapp.addstickers', {initData: props.initData, packCode: pack.code, canGoBack: true})">
                <BetterImage :url="sticker.thumbnail" :has-background="false"/>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.packButton {
  @apply bg-tg-link rounded px-2 py-0.5 text-sm font-semibold;

  &.installed {
    @apply bg-transparent text-tg-link;
  }
}
</style>
