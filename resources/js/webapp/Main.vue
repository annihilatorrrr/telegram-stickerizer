<script setup>
import InputPanel from "@/webapp/InputPanel.vue";
import {onMounted, ref} from "vue";
import PacksPanel from "@/webapp/PacksPanel.vue";

const text = ref(window.initText ?? '');
const webapp = window.Telegram.WebApp;

const setScheme = function () {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
}

const sendStickerCode = async (stickerID) => {
    console.log(stickerID);
    if (webapp.platform === 'unknown') {
        alert('Platform not supported. Please use a supported Telegram client.');
        return;
    }

    if (text.value.length === 0) {
        webapp.showAlert('You need to enter a text to send the sticker.');
        return;
    }

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
        top: calc(var(--tg-viewport-height) - 50px);
        width: 100%;
    }
}
</style>
