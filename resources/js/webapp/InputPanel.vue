<script setup lang="ts">
import {watch} from "vue";

interface Props {
    text: string
    isPanelOpen: boolean
}

const props = defineProps<Props>();
defineEmits(['update:text', 'update:isPanelOpen', 'send']);

watch(() => props.isPanelOpen, (x) => {
    if (!x) {
        document.getElementById('input-text')?.focus();
    }
});

</script>

<template>
    <div class="flex items-center bg-tg-bg h-full">
        <div class="flex-none flex items-center">
            <button id="panelButton" class="w-8 h-8 mx-3" @click="$emit('update:isPanelOpen', !isPanelOpen)">
                <span v-if="isPanelOpen" id="panelButtonKeyboard" class="panelButton"></span>
                <span v-else id="panelButtonSticker" class="panelButton"></span>
            </button>
        </div>
        <div class="flex-1">
            <input :value="text" autofocus id="input-text"
                   @input="$emit('update:text', $event.target.value)"
                   @focus="$emit('update:isPanelOpen', false)"
                   type="text" placeholder="Message"
                   class="w-full h-full bg-tg-bg text-tg-text outline-none placeholder-tg-hint"/>
        </div>
        <div class="flex-none">
            <button id="send" :disabled="!text" @click="$emit('send')">
                <span id="sendIcon"></span>
            </button>
        </div>
    </div>
</template>

<style scoped lang="scss">
#send {
    @apply h-[50px] aspect-square px-3;
    @apply flex items-center justify-center;

    #sendIcon {
        @apply bg-tg-button-bg inline-block w-full aspect-square;
        mask-image: url('../../img/send.svg');
        mask-repeat: no-repeat;
        mask-size: 100%;
    }

    &:disabled {
        @apply opacity-30;
    }
}

.panelButton {
    @apply bg-tg-hint;
    @apply w-8 h-8 inline-block;
    mask-repeat: no-repeat;
    mask-size: 100%;

    &#panelButtonSticker {
        mask-image: url('../../img/sticker.svg');
    }

    &#panelButtonKeyboard {
        mask-image: url('../../img/keyboard.svg');
    }
}
</style>
