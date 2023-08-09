<script setup lang="ts">
interface Props {
    packs: any[];
}

defineProps<Props>();
</script>

<template>
    <div id="packs-panel-container">
        <a v-for="pack in packs"
           :key="`pp${pack.id}`"
           :href="`#P${pack.id}`"
           :style="{backgroundImage: `url(${pack.icon})`}"
           class="pack-icon">
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
        @apply inline-block h-full aspect-square;
        @apply rounded;
        @apply text-white text-center;
        background-size: contain;
        background-repeat: no-repeat;
        box-shadow: 0 0 1px var(--tg-scheme);
    }
}
</style>
