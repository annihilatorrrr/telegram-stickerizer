<script setup>
import ChatBubble from "@/webapp/ChatBubble.vue";
</script>

<template>
    <div class="bg-tg-bg h-full flex flex-col">
        <div class="text-tg-text font-semibold px-3 py-2 flex-none">
            Sticker Preview
        </div>
        <div class="bg-tg-bg-secondary flex-1 relative">
            <div id="preview-content-bg">s</div>
            <div class="p-3 bg-red h-full relative">
                <ChatBubble>Send me a sticker!</ChatBubble>
                <slot/>
                <ChatBubble position="end">Here you go 😉</ChatBubble>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
#preview-content-bg{
    @apply bg-gradient-to-br;
    @apply from-tg-link via-gray-500 via-50% to-tg-button-bg;
    //@apply from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90%;
    mask-image: url('../../img/bg-pattern.svg');
    mask-size: 50%;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}
</style>
