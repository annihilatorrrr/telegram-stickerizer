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
    @apply bg-tg-bg;

    #panel {
        padding-bottom: 50px;
    }

    #input {
        border-top: 2px solid var(--tg-scheme);
        height: 50px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
}
</style>
