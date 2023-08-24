<script setup>
import InputPanel from "@/webapp/InputPanel.vue";
import {computed, onMounted, ref} from "vue";
import StickersPanel from "@/webapp/StickersPanel.vue";
import PacksPanel from "@/webapp/PacksPanel.vue";
import {loadLanguageAsync, trans} from 'laravel-vue-i18n';
import Menu from "@/webapp/Menu.vue";
import 'vue-loading-overlay/dist/css/index.css';

const loading = ref(false);
const favorites = ref([]);
const history = ref([]);
const packs = ref([]);
const text = ref(window.initData.text ?? '');
const menuData = ref(null);
const webapp = window.Telegram.WebApp;

const hasHistory = computed(() => history.value.length > 0);
const hasFavorites = computed(() => favorites.value.length > 0);

const setScheme = function () {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
}

const sendStickerCode = async (stickerID, forcedText) => {
    if (webapp.platform === 'unknown') {
        alert(trans('webapp.platform_not_supported'));
        return;
    }

    if (forcedText === undefined && text.value.length === 0) {
        webapp.HapticFeedback.notificationOccurred('error');
        webapp.showAlert(trans('webapp.empty'));
        return;
    }

    loading.value = true;
    const response = await axios.post(route('webapp.sticker.send'), {
        user_id: window.initData.user_id,
        sticker_id: stickerID,
        text: forcedText ?? text.value,
        fingerprint: window.initData.fingerprint,
    });
    loading.value = false;

    webapp.HapticFeedback.notificationOccurred('success');

    webapp.switchInlineQuery('Ꜣ' + response.data.telegram_sticker_id);
};

const showInfo = () => {
    const message = trans('webapp.info') + '\n' + trans('webapp.limit');

    if (webapp.platform === 'unknown') {
        alert(message);
        return;
    }

    webapp.HapticFeedback.notificationOccurred('warning');
    webapp.showAlert(message);
};

const loadPacks = async () => {
    const response = await axios.get(route('webapp.packs'), {
        params: {
            user_id: window.initData.user_id,
            fingerprint: window.initData.fingerprint,
        }
    });
    packs.value = response.data;
};

const loadHistory = async () => {
    const response = await axios.get(route('webapp.sticker.history.list'), {
        params: {
            user_id: window.initData.user_id,
            fingerprint: window.initData.fingerprint,
        }
    });
    history.value = response.data;
};

const loadFavorites = async () => {
    const response = await axios.get(route('webapp.sticker.favorite.list'), {
        params: {
            user_id: window.initData.user_id,
            fingerprint: window.initData.fingerprint,
        }
    });
    favorites.value = response.data;
};

const clearHistory = async () => {
    webapp.showConfirm(trans('webapp.clear'), async function (result) {
        if (result) {
            loading.value = true;
            await axios.delete(route('webapp.sticker.history.clear'), {
                params: {
                    user_id: window.initData.user_id,
                    fingerprint: window.initData.fingerprint,
                }
            });
            await loadHistory();
            loading.value = false;
        }
    });
};

const openMenu = (data) => {
    menuData.value = data;
};

const saveFavorite = async (sticker, text) => {
    await axios.post(route('webapp.sticker.favorite.save'), {
        user_id: window.initData.user_id,
        fingerprint: window.initData.fingerprint,
        sticker_id: sticker,
        text: text,
    });
    await loadFavorites();
}

const removeFavorite = async (favorite_id) => {
    await axios.delete(route('webapp.sticker.favorite.delete', {favorite: favorite_id}), {
        params: {
            user_id: window.initData.user_id,
            fingerprint: window.initData.fingerprint,
        }
    });
    await loadFavorites();
}

onMounted(() => {
    setScheme();
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.expand();
    loadLanguageAsync(window.initData.lang ?? 'en');
    loadFavorites();
    loadHistory();
    loadPacks();
    webapp.ready();
});
</script>

<template>
    <Loading v-model:active="loading"
             :can-cancel="false"
             :is-full-page="true"
             :lock-scroll="true"
             color="var(--tg-theme-button-color)"
             background-color="var(--tg-scheme)"
    />

    <Menu :isOpen="menuData!==null"
          v-model:data="menuData"
          @send="(x) => sendStickerCode(x.sticker, x.text)"
          @saveTemplate="(x) => saveFavorite(x.sticker, null)"
          @saveSticker="(x) => saveFavorite(x.sticker, x.text)"
          @removeFavorite="removeFavorite"
    />

    <div class="layout">
        <div id="stickers-panel">
            <StickersPanel
                v-model:favorites="favorites"
                v-model:history="history"
                v-model:packs="packs"
                v-model:text="text"
                @send="sendStickerCode"
                @sendFromHistory="(x) => sendStickerCode(x.sticker, x.text)"
                @clearHistory="clearHistory"
                @menu="openMenu"
            />
        </div>
        <div id="packs-panel">
            <PacksPanel v-model:hasHistory="hasHistory"
                        v-model:hasFavorites="hasFavorites"
                        v-model:packs="packs"
            />
        </div>
        <div id="input">
            <InputPanel v-model:text="text" @info="showInfo"/>
        </div>
    </div>
</template>

<style scoped lang="scss">
.layout {
    @apply bg-tg-bg;
    height: 100vh;

    --packs-panel-height: 40px;
    --input-panel-height: 50px;

    #stickers-panel {
        padding-bottom: 80px;
        height: 100vh;
    }

    #packs-panel {
        border-top: 1px solid var(--tg-scheme);
        height: var(--packs-panel-height);
        position: fixed;
        top: calc(var(--tg-viewport-height) - (var(--packs-panel-height) + var(--input-panel-height)));
        width: 100%;
    }

    #input {
        border-top: 1px solid var(--tg-scheme);
        height: var(--input-panel-height);
        position: fixed;
        top: calc(var(--tg-viewport-height) - var(--input-panel-height));
        width: 100%;
    }
}
</style>
