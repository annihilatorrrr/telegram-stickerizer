<script setup lang="ts">
import {onMounted, ref} from "vue";
import route from "ziggy-js";
import BetterImage from "@/webapp/BetterImage.vue";

interface Props {
    text: string
}

defineProps<Props>();
defineEmits(['send']);

const packs = ref([]);

onMounted(async () => {
    const response = await axios.get(route('webapp.packs'));
    packs.value = response.data;
});

</script>

<template>
    <div class="p-3 bg-tg-bg">
        <div v-for="pack in packs" :key="`p${pack.id}`" class="pb-2 mb-2">
            <p class="text-tg-hint font-semibold text-sm mb-2">{{ pack.name }}</p>
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
