<script setup lang="ts">
import route from "ziggy-js";
import BetterImage from "@/Components/BetterImage.vue";
import {computed} from "vue";
import {trans} from 'laravel-vue-i18n';

interface Props {
    text: string;
    favorites: any[];
    history: any[];
    packs: any[];
}

const props = defineProps<Props>();
defineEmits(['send', 'sendFromHistory', 'clearHistory', 'menu']);

const hasHistory = computed(() => props.history.length > 0);
const hasFavorites = computed(() => props.favorites.length > 0);
const hasPacks = computed(() => props.packs.length > 0);
</script>

<template>
    <div class="bg-tg-bg" :class="{'h-full': !hasFavorites && !hasHistory && !hasPacks}">
        <div class="pb-2 mb-2" v-if="hasFavorites">
            <div class="flex mb-2">
                <a id="favorites" class="flex-auto text-tg-hint font-semibold text-sm block cursor-default">
                    {{ trans('webapp.favorite.title') }}
                </a>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="item in favorites"
                             :url="route('webapp.sticker.preview', {sticker: item.sticker_id, text: item.text ?? text})"
                             @click="$emit('sendFromHistory', {sticker: item.sticker_id, text: item.text ?? text});"
                             @contextmenu.prevent="$emit('menu', {mode:'removeFavorite', favorite_id: item.id, sticker: item.sticker_id, text: item.text ?? text});"
                />
            </div>
        </div>

        <div class="pb-2 mb-2" v-if="hasHistory">
            <div class="flex mb-2">
                <a id="history" class="flex-auto text-tg-hint font-semibold text-sm block cursor-default">
                    {{ trans('webapp.history') }}
                </a>
                <button @click="$emit('clearHistory')" class="inline-block px-">
                    <font-awesome-icon icon="fa-solid fa-xmark" class="text-tg-hint"/>
                </button>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="item in history"
                             :url="route('webapp.sticker.preview', {sticker: item.sticker_id, text: item.text})"
                             @click="$emit('sendFromHistory', {sticker: item.sticker_id, text: item.text});"
                             @contextmenu.prevent="$emit('menu', {mode: 'default', sticker: item.sticker_id, text: item.text});"
                />
            </div>
        </div>

        <div class="flex items-center justify-center h-full" v-if="!hasPacks">
            <div class="text-center text-tg-hint">
                <font-awesome-icon icon="fa-regular fa-face-sad-tear" class="text-6xl"/>
                <p class="text-xl my-5">{{ trans('webapp.no_packs') }}</p>
            </div>
        </div>

        <div v-for="pack in packs" :key="`p${pack.id}`" class="pb-2 mb-2">
            <a :id="`P${pack.id}`" class="text-tg-hint font-semibold text-sm mb-2 block cursor-default">
                {{ pack.name }}
            </a>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="sticker in pack.stickers"
                             :key="`s${sticker.id}`"
                             :url="route('webapp.sticker.preview', {sticker: sticker.id, text: text})"
                             @click="$emit('send', sticker.id);"
                             @contextmenu.prevent="$emit('menu', {mode: 'default', sticker: sticker.id, text: text});"
                />
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.v-progressive-image {
    background: none;
}

.selectedSticker {
    box-shadow: 0 0 0 2px var(--tg-theme-link-color);
    border: 2px solid var(--tg-theme-bg-color);
}

.sticker {
    cursor: pointer;

    &:hover {
        box-shadow: 0 0 0 2px var(--tg-theme-link-color);
        border: 2px solid var(--tg-theme-bg-color);
    }
}
</style>
