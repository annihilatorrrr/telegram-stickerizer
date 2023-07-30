<script setup lang="ts">
import {computed} from "vue";

interface Props {
    sticker?: number;
    text?: string;
}

const props = defineProps<Props>();

const img = computed(function () {
    if (!props.sticker || !props.text) {
        return null;
    }

    return route('webapp.sticker.preview', {
        sticker: props.sticker,
        text: props.text,
    });
});
</script>

<template>
    <div id="stickerPreviewContainer">
        <div id="stickerPreviewContent" :class="{empty:!img}" :style="{backgroundImage:img?`url(${img})`:'none'}">
            <span v-if="!sticker">
                Select a sticker from the bottom panel to preview it here.
            </span>
            <span v-if="!text">
                Enter some text to preview it here.
            </span>
        </div>
    </div>
</template>

<style scoped lang="scss">
#stickerPreviewContainer {
    display: grid;
    column-gap: 0;
    padding-top: .25rem;
    padding-bottom: .25rem;

    place-items: end;
    grid-template-columns: 1fr auto;

    #stickerPreviewContent {
        position: relative;
        display: block;
        grid-column-start: 1;
        @apply w-52 h-52 text-center;
        background-size: 100% 100%;
        background-position: center;
        @apply flex justify-center items-center text-lg p-4;

        &.empty {
            border: 2px dashed var(--tg-theme-hint-color);
            @apply bg-tg-bg text-tg-hint;
        }
    }
}
</style>
