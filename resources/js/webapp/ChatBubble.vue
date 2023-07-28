<script setup lang="ts">
import {withDefaults} from "vue";

interface IProps {
    user?: string;
    position?: 'start' | 'end';
}

withDefaults(defineProps<IProps>(), {
    position: 'start',
});
</script>

<template>
    <div class="chat" :class="{'chat-start':position==='start', 'chat-end':position==='end'}">
        <div class="chat-bubble">
            <p class="font-bold" v-if="user">{{user}}</p>
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
.chat{
    display: grid;
    grid-template-columns: repeat(2,minmax(0,1fr));
    column-gap: 0;
    padding-top: .25rem;
    padding-bottom: .25rem;
    font-size: 14px;

    .chat-bubble {
        position: relative;
        display: block;
        padding: .3rem .8rem;
        border-radius: var(--rounded-box,1rem);
        @apply bg-gradient-to-br from-pink-500 to-yellow-600;
        color: white;
        text-shadow: 2px 1px 5px rgb(0,0,0);

        &::before {
            position: absolute;
            bottom: 0;
            height: .75rem;
            width: .75rem;
            background-color: inherit;
            content: "";
            mask-size: contain;
            mask-repeat: no-repeat;
            mask-position: center;
        }
    }

    &.chat-start{
        place-items: start;
        grid-template-columns: auto 1fr;

        .chat-bubble {
            grid-column-start: 2;
            border-bottom-left-radius: 0;
        }
    }

    &.chat-end{
        place-items: end;
        grid-template-columns: 1fr auto;

        .chat-bubble {
            grid-column-start: 1;
            border-bottom-right-radius: 0;
        }
    }
}
</style>
