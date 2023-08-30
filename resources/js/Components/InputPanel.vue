<script setup lang="ts">
import {onMounted} from "vue";
import debounce from "lodash.debounce";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {trans} from 'laravel-vue-i18n';

interface Props {
    text: string
}

defineProps<Props>();
const emits = defineEmits(['update:text', 'info']);

const onInput = debounce((event) => emits('update:text', event.target.value), 800);

onMounted(() => {
    document.getElementById('input-text')?.focus();
});

</script>

<template>
    <div class="flex items-center bg-tg-bg h-full">
        <div class="flex-1">
            <input :value="text" autofocus tabindex="1" id="input-text" maxlength="150"
                   @input="onInput"
                   type="text" :placeholder="trans('webapp.message')"
                   class="w-full text-tg-text outline-none placeholder-tg-hint pl-3 bg-transparent"/>
        </div>
        <div class="flex-none h-full">
            <button
                class="hover:bg-tg-link group/icon h-full px-3"
                @click="$emit('info')">
                <font-awesome-icon icon="fa-regular fa-circle-question"
                                   class="text-tg-hint group-hover/icon:text-white"/>
            </button>
        </div>
    </div>
</template>

<style scoped lang="scss">
</style>
