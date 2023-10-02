<script setup lang="ts">
import '@css/webapp.scss';
import InlineInitData from "@/Types/InlineInitData";
import InputPanel from "@/Components/InputPanel.vue";
import StickersPanel from "@/Components/StickersPanel.vue";
import Menu from "@/Components/Menu.vue";
import PacksPanel from "@/Components/PacksPanel.vue";
import {computed, onMounted, ref, watch} from "vue";
import {loadLanguageAsync, trans} from 'laravel-vue-i18n';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import axios from "axios";
import route from "ziggy-js";
import WebApp from '@twa-dev/sdk';

interface Props {
    initData: InlineInitData;
    text: string;
}
const props = defineProps<Props>();

const loading = ref(false);
const user = ref(null);
const search = ref('');
const favorites = ref([]);
const history = ref([]);
const packs = ref([]);
const text = ref(props.text ?? '');
const menuData = ref(null);

const hasHistory = computed(() => history.value.length > 0);
const hasFavorites = computed(() => favorites.value.length > 0);

const setScheme = function () {
    if (WebApp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', WebApp.colorScheme);
    }
}

const sendStickerCode = async (stickerID:number, forcedText:string = null) => {
    if (WebApp.platform === 'unknown') {
        alert(trans('webapp.platform_not_supported'));
        return;
    }

    if (forcedText === null && text.value.length === 0) {
        WebApp.HapticFeedback.notificationOccurred('error');
        WebApp.showAlert(trans('webapp.empty'));
        return;
    }

    loading.value = true;
    const response = await axios.post(route('webapp.sticker.send'), {
        user_id: props.initData.user_id,
        fingerprint: props.initData.fingerprint,
        text: forcedText ?? text.value,
        sticker_id: stickerID,
    });
    loading.value = false;

    WebApp.HapticFeedback.notificationOccurred('success');

    WebApp.switchInlineQuery('Ꜣ' + response.data.telegram_sticker_id);
};

const showInfo = () => {
    const message = trans('webapp.info') + '\n' + trans('webapp.limit');

    if (WebApp.platform === 'unknown') {
        alert(message);
        return;
    }

    WebApp.HapticFeedback.notificationOccurred('warning');
    WebApp.showAlert(message);
};

const loadUser = async () => {
    try {
        const response = await axios.get(route('webapp.user'), {
            params: {
                user_id: props.initData.user_id,
                fingerprint: props.initData.fingerprint,
            },
        });
        user.value = response.data;
    } catch (e) {
    }
};

const loadPacks = async () => {
    const response = await axios.get(route('webapp.packs'), {
        params: {
            user_id: props.initData.user_id,
            fingerprint: props.initData.fingerprint,
        },
    });
    packs.value = response.data;
};

const loadHistory = async () => {
    const response = await axios.get(route('webapp.sticker.history.list'), {
        params: {
            user_id: props.initData.user_id,
            fingerprint: props.initData.fingerprint,
        }
    });
    history.value = response.data;
};

const loadFavorites = async () => {
    const response = await axios.get(route('webapp.sticker.favorite.list'), {
        params: {
            user_id: props.initData.user_id,
            fingerprint: props.initData.fingerprint,
        }
    });
    favorites.value = response.data;
};

const clearHistory = async () => {
    WebApp.showConfirm(trans('webapp.clear.history'), async function (result) {
        if (result) {
            loading.value = true;
            await axios.delete(route('webapp.sticker.clear.history'), {
                params: {
                    user_id: props.initData.user_id,
                    fingerprint: props.initData.fingerprint,
                }
            });
            await loadHistory();
            loading.value = false;
        }
    });
};

const clearFavorites = async () => {
    WebApp.showConfirm(trans('webapp.clear.favorites'), async function (result) {
        if (result) {
            loading.value = true;
            await axios.delete(route('webapp.sticker.clear.favorite'), {
                params: {
                    user_id: props.initData.user_id,
                    fingerprint: props.initData.fingerprint,
                }
            });
            await loadFavorites();
            loading.value = false;
        }
    });
};

const openMenu = (data:any) => {
    menuData.value = data;
};

const saveFavorite = async (sticker:number, text:string) => {
    await axios.post(route('webapp.sticker.favorite.save'), {
        user_id: props.initData.user_id,
        fingerprint: props.initData.fingerprint,
        sticker_id: sticker,
        text: text,
    });
    await loadFavorites();
};

const removeFavorite = async (favorite_id:number) => {
    await axios.delete(route('webapp.sticker.favorite.delete', {favorite: favorite_id}), {
        params: {
            user_id: props.initData.user_id,
            fingerprint: props.initData.fingerprint,
        }
    });
    await loadFavorites();
};

const removePack = (packID:number) => {
    WebApp.showConfirm(trans('webapp.remove_pack'), async function (result) {
        if (result) {
            await axios.post(route('webapp.store.pack.remove', {pack: packID}), {
                user_id: props.initData.user_id,
                fingerprint: props.initData.fingerprint,
            });
            await loadPacks();
        }
    });
};

const openStorePage = () => {
    location.href = route('webapp.store', {
        user_id: props.initData.user_id,
        fingerprint: props.initData.fingerprint,
    });
};

watch(user, (newUser) => {
    if (newUser) {
        loadLanguageAsync(newUser.language ?? 'en');
    }
});

onMounted(async () => {
    WebApp.BackButton.hide();
    setScheme();
    WebApp.setHeaderColor('#056104');
    WebApp.onEvent('themeChanged', () => setScheme());
    WebApp.expand();
    await loadUser();
    loadFavorites();
    loadHistory();
    loadPacks();
    WebApp.ready();
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
        <div id="search-panel">
            <div id="search-box">
                <font-awesome-icon icon="fa-solid fa-magnifying-glass" size="sm"/>
                <input type="text"
                       id="search-input"
                       :placeholder="trans('common.search')"
                       maxlength="50"
                       :value="search"
                       @input="(event) => search = event.target.value"
                />
                <button v-if="search" @click="() => search=''">
                    <font-awesome-icon icon="fa-solid fa-xmark"/>
                </button>
            </div>
        </div>

        <div id="stickers-panel">
            <StickersPanel
                    v-model:search="search"
                    v-model:favorites="favorites"
                    v-model:history="history"
                    v-model:packs="packs"
                    v-model:text="text"
                    @send="sendStickerCode"
                    @sendFromHistory="(x) => sendStickerCode(x.sticker, x.text)"
                    @clearHistory="clearHistory"
                    @clearFavorites="clearFavorites"
                    @menu="openMenu"
                    @removePack="removePack"
            />
        </div>
        <div id="packs-panel">
            <PacksPanel v-model:hasHistory="hasHistory"
                        v-model:hasFavorites="hasFavorites"
                        v-model:packs="packs"
                        @iconClick="() => search = ''"
                        @storeClick="openStorePage"
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
    height: 100%;

    --padding-top: 10px;
    --search-panel-height: 50px;
    --packs-panel-height: 40px;
    --input-panel-height: 50px;

    padding-top: calc(var(--search-panel-height) + var(--padding-top));

    #search-panel {
        @apply bg-tg-bg;
        @apply px-3;
        @apply flex items-center justify-center h-full;
        height: var(--search-panel-height);
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 10;

        #search-box {
            @apply flex items-center;
            @apply rounded-3xl w-full px-3 py-1;
            @apply text-tg-hint bg-tg-bg-secondary;

            #search-input {
                @apply inline-block flex-auto;
                @apply text-white bg-transparent caret-tg-button-bg;
                @apply outline-0 px-1;
            }
        }
    }

    #stickers-panel {
        height: 100%;

        & > div:first-child {
            @apply px-3;
            padding-bottom: calc(var(--packs-panel-height) + var(--input-panel-height) + var(--padding-top));
        }
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
