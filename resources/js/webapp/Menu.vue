<script setup lang="ts">
import {onMounted, watch} from "vue";
import BetterImage from "@/webapp/BetterImage.vue";
import route from "ziggy-js";
import {trans} from 'laravel-vue-i18n';

interface Props {
    isOpen: boolean;
    data: {
        mode: 'default' | 'removeFavorite';
        favorite_id?: number;
        sticker: number;
        text?: string;
    } | null;
}

const props = defineProps<Props>();
const emits = defineEmits(['update:data', 'send', 'saveTemplate', 'saveSticker', 'removeFavorite']);

const checkBodyOverflow = () => {
    if (props.isOpen) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'auto';
    }
};

const onSend = () => {
    emits('send', {sticker: props.data.sticker, text: props.data.text});
    emits('update:data', null);
};

const onSaveTemplate = () => {
    emits('saveTemplate', {sticker: props.data.sticker, text: null});
    emits('update:data', null);
};

const onSaveSticker = () => {
    emits('saveSticker', {sticker: props.data.sticker, text: props.data.text});
    emits('update:data', null);
};

const onRemoveFavorite = () => {
    emits('removeFavorite', props.data.favorite_id);
    emits('update:data', null);
};

watch(() => props.isOpen, (isOpen) => checkBodyOverflow());
onMounted(() => {
    console.log(props.data);
    checkBodyOverflow();
});
</script>

<template>
    <div class="menu-box" v-if="isOpen" @click="$emit('update:data', null)">
        <div class="flex flex-col h-full">
            <div class="basis-2/5 grow-0 p-5 text-center flex items-center justify-center">
                <BetterImage :url="route('webapp.sticker.preview', {sticker: data.sticker, text: data.text})"/>
            </div>
            <div class="basis-3/5 p-5 text-center">
                <div class="menu-dropdown">
                    <button class="menu-dropdown-item" @click.stop="onSend">
                        <font-awesome-icon icon="fa-regular fa-paper-plane" class="text-tg-hint pr-2"/>
                        {{ trans('webapp.send') }}
                    </button>
                    <button class="menu-dropdown-item" @click.stop="onSaveTemplate" v-if="data.mode === 'default'">
                        <font-awesome-icon icon="fa-regular fa-star" class="text-tg-hint pr-2"/>
                        {{ trans('webapp.favorite.template') }}
                    </button>
                    <button class="menu-dropdown-item" @click.stop="onSaveSticker"
                            v-if="data.mode === 'default' && data.text">
                        <font-awesome-icon icon="fa-regular fa-star" class="text-tg-hint pr-2"/>
                        {{ trans('webapp.favorite.sticker') }}
                    </button>
                    <button class="menu-dropdown-item" @click.stop="onRemoveFavorite"
                            v-if="data.mode === 'removeFavorite'">
                        <font-awesome-icon icon="fa-regular fa-trash-can" class="text-tg-hint pr-2"/>
                        {{ trans('webapp.favorite.remove') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.menu-box {
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(15px);
    background-color: color-mix(in srgb, var(--tg-scheme) 25%, transparent);
    z-index: 100;
}

.menu-dropdown {
    @apply bg-tg-bg rounded-lg shadow-xl;
    @apply text-left py-2;

    .menu-dropdown-item {
        @apply block w-full text-left;
        @apply px-4 py-3;

        &:active {
            @apply bg-tg-link text-white;

            * {
                @apply text-white;
            }
        }
    }
}
</style>
