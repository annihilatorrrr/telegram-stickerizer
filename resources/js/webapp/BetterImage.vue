<script setup lang="ts">
import {ref, watch} from 'vue'
import {vElementVisibility} from '@vueuse/components'

interface Props {
    url: string
}

const props = defineProps<Props>();

const isVisible = ref(false);
const isLoading = ref(true);

const onElementVisibility = (state) => isVisible.value = state;

const loadImage = () => {
    const image = new Image();
    image.onload = () => isLoading.value = false;
    image.src = props.url;
}

watch(() => isVisible.value && props.url, (state) => {
    if (state) {
        loadImage();
    }
}, {immediate: true});

</script>

<template>
    <div class="better-image"
         :class="{'active': isVisible}"
         :style="{backgroundImage: isVisible && !isLoading ? `url(${props.url})`:'none'}"
         v-element-visibility="onElementVisibility">
        <font-awesome-icon icon="fa-solid fa-circle-notch" size="2x" spin v-if="isVisible && isLoading"/>
    </div>
</template>

<style scoped lang="scss">
.better-image {
    //@apply bg-red-500;
    @apply aspect-square rounded;
    @apply flex items-center justify-center;
    @apply bg-contain bg-no-repeat bg-center;
    box-shadow: 0 0 3px var(--tg-scheme);

    &.active {
        //@apply bg-green-500;
    }
}
</style>
