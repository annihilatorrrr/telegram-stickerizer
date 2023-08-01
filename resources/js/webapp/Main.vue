<script setup>
import Input from "@/webapp/InputPanel.vue";
import {onMounted, ref, watch} from "vue";
import PreviewPanel from "@/webapp/PreviewPanel.vue";
import StickerPreview from "@/webapp/StickerPreview.vue";
import PacksPanel from "@/webapp/PacksPanel.vue";

const text = ref(window.initText ?? '');
const isPanelOpen = ref(false);
const stickerID = ref(1);
const webapp = window.Telegram.WebApp;

const setScheme = function () {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
}

const checkPanelOpen = function () {
    document.querySelector('#panel').style.display = isPanelOpen.value ? 'block' : 'none';
}

const sendStickerCode = async () => {
    const response = await axios.post(route('webapp.sticker.send'), {
        user_id: window.initUser,
        sticker_id: stickerID.value,
        text: text.value,
    });

    webapp.switchInlineQuery('Ꜣ' + response.data.telegram_sticker_id);
};

onMounted(() => {
    setScheme();
    checkPanelOpen();
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.onEvent('viewportChanged', function ({isStateStable}) {
        console.log('viewport', {
            isStateStable,
            viewportHeight: webapp.viewportHeight,
            viewportStableHeight: webapp.viewportStableHeight,
        });
    });
    webapp.expand();
    webapp.ready();
});

watch(isPanelOpen, () => checkPanelOpen());
</script>

<template>
    <div class="layout">
        <div id="preview">
            <PreviewPanel>
                <StickerPreview v-model:sticker="stickerID" v-model:text="text"/>
            </PreviewPanel>
        </div>
        <div id="input">
            <Input v-model:text="text" v-model:isPanelOpen="isPanelOpen" @send="sendStickerCode"/>
        </div>
        <div id="panel">
            <PacksPanel v-model:stickerID="stickerID"/>
        </div>
    </div>
</template>

<style scoped lang="scss">
.layout {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 50px auto;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    height: 100%;

    #preview {
        grid-area: 1 / 1 / 2 / 2;
    }

    #input {
        grid-area: 2 / 1 / 3 / 2;
    }

    #panel {
        grid-area: 3 / 1 / 4 / 2;
        height: 40vh;
        overflow-y: scroll;
        margin-top: 1px;
        @apply bg-tg-bg;
    }
}
</style>
