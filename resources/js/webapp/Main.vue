<script setup>
import Input from "@/webapp/InputPanel.vue";
import {onMounted, ref} from "vue";
import StickerPreview from "@/webapp/PreviewPanel.vue";

const text = ref(window.initText ?? '');
const isPanelOpen = ref(false);
const webapp = window.Telegram.WebApp;

const setScheme = function(){
    if(webapp.platform === 'unknown'){
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
}

onMounted(() => {
    setScheme();
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.expand();
    webapp.ready();
});

const sendStickerCode = async () => {
    const response = await axios.post(route('webapp.sticker.send'),{
        user_id: window.initUser,
        sticker_id: 1,
        text: text.value,
    });

    webapp.switchInlineQuery('Ꜣ' + response.data.telegram_sticker_id);
};

</script>

<template>
    <div class="layout">
        <div id="preview">
            <StickerPreview/>
        </div>
        <div id="input">
            <Input v-model:text="text" v-model:isPanelOpen="isPanelOpen" @send="sendStickerCode"/>
        </div>
        <div id="panel">Panel (Packs + Stickers)</div>
    </div>
</template>

<style scoped lang="scss">
.layout {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 50px 1fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    height: 100%;

    #preview {
        grid-area: 1 / 1 / 2 / 2;
        padding-top: 1px;
    }

    #input {
        grid-area: 2 / 1 / 3 / 2;
    }

    #panel {
        grid-area: 3 / 1 / 4 / 2;
        background: blue;
    }
}
</style>
