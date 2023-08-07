<script setup>
import InputPanel from "@/webapp/InputPanel.vue";
import {onMounted, ref} from "vue";
import PacksPanel from "@/webapp/PacksPanel.vue";

const text = ref(window.initText ?? '');
const stickerID = ref(1);
const webapp = window.Telegram.WebApp;

const setScheme = function () {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
}

const sendStickerCode = async (stickerID) => {
    const response = await axios.post(route('webapp.sticker.send'), {
        user_id: window.initUser,
        sticker_id: stickerID,
        text: text.value,
    });

    webapp.switchInlineQuery('Ꜣ' + response.data.telegram_sticker_id);
};

const showInfo = () => {
    if (webapp.platform === 'unknown') {
        alert('Click on a sticker to send it to the chat.');
        return;
    }

    webapp.showAlert('Click on a sticker to send it to the chat.');
};

onMounted(() => {
    setScheme();
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.onEvent('viewportChanged', function ({isStateStable}) {
        /*console.log('viewport', {
            isStateStable,
            viewportHeight: webapp.viewportHeight,
            viewportStableHeight: webapp.viewportStableHeight,
        });*/
    });
    webapp.expand();
    webapp.ready();
});
</script>

<template>
    <div class="layout">
        <div id="panel">
            <PacksPanel v-model:text="text" @send="sendStickerCode"/>
        </div>
        <div id="input">
            <InputPanel v-model:text="text" @info="showInfo"/>
        </div>
    </div>
</template>

<style scoped lang="scss">
.layout {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr 50px;
    grid-column-gap: 0px;
    grid-row-gap: 2px;
    height: 100%;

    #panel {
        grid-area: 1 / 1 / 2 / 2;
        overflow-y: scroll;
        margin-top: 1px;
        @apply bg-tg-bg;
        height: calc(100vh - 50px);
        overscroll-behavior: none;
        pointer-events: auto;
    }

    #input {
        grid-area: 2 / 1 / 3 / 2;
    }
}
</style>
