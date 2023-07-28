<script setup lang="ts">
interface Props {
    text: string
    isPanelOpen: boolean
}

defineProps<Props>();
defineEmits(['update:text', 'update:isPanelOpen', 'send']);
</script>

<template>
    <div class="flex items-center bg-tg-bg h-full px-3">
        <div class="flex-none flex items-center">
            <button id="panelButton" class="w-8 h-8 mr-3" @click="$emit('update:isPanelOpen', !isPanelOpen)">
                <span v-if="isPanelOpen" id="panelButtonKeyboard"></span>
                <span v-else id="panelButtonSticker"></span>
            </button>
        </div>
        <div class="flex-1">
            <input :value="text"
                   @input="$emit('update:text', $event.target.value)"
                   type="text" placeholder="Message"
                   class="w-full h-full bg-tg-bg text-tg-text outline-none placeholder-tg-hint"/>
        </div>
        <div class="flex-none flex items-center">
            <button id="send" class="w-5 h-5" :disabled="!text" @click="$emit('send')">
                <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="Icon">
                        <path
                            d="m1.305 3.542c-.175-.699.074-1.435.636-1.886s1.335-.533 1.979-.211l17.81 8.905c.625.312 1.02.951 1.02 1.65s-.395 1.338-1.02 1.65l-17.81 8.905c-.644.322-1.417.24-1.979-.211s-.811-1.187-.636-1.886l1.865-7.458 10.83-1-10.83-1-1.865-7.458z"/>
                    </g>
                </svg>
            </button>
        </div>
    </div>
</template>

<style scoped lang="scss">
#send {
    svg {
        @apply fill-tg-button-bg;
    }

    &:disabled svg {
        @apply opacity-30;
    }
}

#panelButtonSticker{
    @apply bg-tg-hint;
    @apply w-8 h-8 inline-block;
    mask-image: url('../../img/sticker.svg');
    mask-repeat: no-repeat;
    mask-size: 100%;
}

#panelButtonKeyboard{
    @apply bg-tg-hint;
    @apply w-8 h-8 inline-block;
    mask-image: url('../../img/keyboard.svg');
    mask-repeat: no-repeat;
    mask-size: 100%;
}
</style>
