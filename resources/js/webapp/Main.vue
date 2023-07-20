<script setup>
import Input from "@/webapp/Input.vue";
import {onMounted, ref} from "vue";

const text = ref(window.initText);
const webapp = window.Telegram.WebApp;
onMounted(() => {
    webapp.expand();
    webapp.ready();
});

const sendStickerCode = () => {
    webapp.switchInlineQuery('Ꜣ' + text.value);
};

</script>

<template>
    <div class="layout">
        <div id="preview">Preview</div>
        <div id="panel">Panel (Packs + Stickers)</div>
        <div id="input">
            <Input v-model="text" @send="sendStickerCode"/>
        </div>
    </div>
</template>

<style scoped lang="scss">
.layout {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 1fr 50px;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    height: 100%;

    #preview {
        grid-area: 1 / 1 / 2 / 2;
        background: red;
    }

    #panel {
        grid-area: 2 / 1 / 3 / 2;
        background: blue;
    }

    #input {
        grid-area: 3 / 1 / 4 / 2;
    }
}
</style>
