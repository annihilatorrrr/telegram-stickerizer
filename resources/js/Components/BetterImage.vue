<script setup lang="ts">
import {ref, watch} from 'vue'
import {vElementVisibility} from '@vueuse/components'
import {trans} from 'laravel-vue-i18n';

interface Props {
    url: string;
    isTemplate?: boolean;
}

const props = defineProps<Props>();

const image = new Image();
image.onload = () => isLoading.value = false;

const isVisible = ref(false);
const isLoading = ref(true);

const onElementVisibility = (state) => isVisible.value = state;

const loadImage = () => {
    isLoading.value = true;
    image.src = props.url;
}

const stopLoading = () => {
    isLoading.value = false;
    image.src = '';
}

watch(() => isVisible.value && props.url, (state) => {
    if (state) {
        loadImage();
    }
}, {immediate: true});

watch(() => isVisible.value, (state) => {
    if (!state) {
        stopLoading();
    }
});

</script>

<template>
    <div class="better-image"
         :class="{'isTemplate': props.isTemplate}"
         :style="{backgroundImage: isVisible && !isLoading ? `url(${props.url})`:'none'}"
         v-element-visibility="onElementVisibility">
        <div v-if="isTemplate" class="isTemplate">
            {{ trans('common.template').toUpperCase() }}
        </div>
        <font-awesome-icon icon="fa-solid fa-circle-notch" size="2x" spin v-if="isVisible && isLoading"/>
    </div>
</template>

<style scoped lang="scss">
.better-image {
    @apply aspect-square rounded h-full;
    @apply flex items-center justify-center;
    @apply bg-contain bg-no-repeat bg-center;
    background-color: rgba(0, 0, 0, 0.1);
    @apply relative;

    .isTemplate{
        @apply bg-yellow-500 text-black font-bold rounded;
        @apply px-2;
        @apply absolute;
        top: -6px;
        //right: -10px;
        font-size: 0.5rem;
    }
}
</style>
