<script setup lang="ts">
import route from "ziggy-js";
import BetterImage from "@/webapp/BetterImage.vue";
import {computed} from "vue";
import {trans} from 'laravel-vue-i18n';

interface Props {
    text: string;
    history: any[];
    packs: any[];
}

const props = defineProps<Props>();
defineEmits(['send', 'sendFromHistory', 'clearHistory']);

const hasHistory = computed(() => props.history.length > 0);
</script>

<template>
    <div class="p-3 bg-tg-bg">
        <div class="pb-2 mb-2" v-if="hasHistory">
            <div class="flex mb-2">
                <a :id="`history`" class="flex-auto text-tg-hint font-semibold text-sm block cursor-default">
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
                />
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
