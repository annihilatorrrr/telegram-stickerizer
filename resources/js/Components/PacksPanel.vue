<script setup lang="ts">
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

interface Props {
    hasFavorites: boolean;
    hasHistory: boolean;
    packs: any[];
}

defineProps<Props>();
defineEmits(['iconClick', 'storeClick']);
</script>

<template>
    <div id="packs-panel-container">
        <a href="#" @click.prevent="$emit('storeClick')"
           class="pack-icon flex items-center justify-center"
           style="background-color: transparent !important;">
            <font-awesome-icon icon="fa-solid fa-boxes-stacked" size="xl" class="text-tg-hint"/>
        </a>

        <a v-if="hasFavorites" href="#favorites" @click="$emit('iconClick')"
           class="pack-icon flex items-center justify-center"
           style="background-color: transparent !important;">
            <font-awesome-icon icon="fa-regular fa-star" size="xl" class="text-tg-hint"/>
        </a>

        <a v-if="hasHistory" href="#history" @click="$emit('iconClick')"
           class="pack-icon flex items-center justify-center"
           style="background-color: transparent !important;">
            <font-awesome-icon icon="fa-regular fa-clock" size="xl" class="text-tg-hint"/>
        </a>

        <a v-for="pack in packs"
           @click="$emit('iconClick')"
           :key="`pp${pack.id}`"
           :href="`#P${pack.id}`"
           :style="{backgroundImage: `url(${pack.icon})`}"
           class="pack-icon inline-block">
        </a>
    </div>
</template>

<style scoped lang="scss">
#packs-panel-container {
    @apply h-full px-3 py-1 overflow-x-auto overflow-y-clip;
    @apply flex flex-row gap-x-2;
    @apply bg-tg-bg;
    box-sizing: border-box;

    .pack-icon {
        @apply h-full aspect-square;
        @apply rounded;
        @apply text-white text-center;
        background-size: contain;
        background-repeat: no-repeat;
        background-color: rgba(0, 0, 0, 0.1);
    }
}
</style>
