<script setup lang="ts">
import {MainButton, useWebAppNavigation, useWebAppPopup} from "vue-tg";
import {computed, onMounted, ref, watch} from "vue";
import axios from "axios";
import route from "ziggy-js";
import colors from 'tailwindcss/colors';
import User from "@/Types/User";
import Pack from "@/Types/Pack";
import {loadLanguageAsync, trans, trans_choice} from "laravel-vue-i18n";
import BetterImage from "@/Components/BetterImage.vue";
import { type MenuOptions, ContextMenu, ContextMenuItem } from '@imengyu/vue3-context-menu';
import { useClipboard } from '@vueuse/core';

const { copy } = useClipboard();

const {showAlert, showPopup} = useWebAppPopup();
const {openTelegramLink, switchInlineQuery} = useWebAppNavigation();
const webapp = window.Telegram.WebApp;
const appData = window.initData;
const menuOpen = ref(false);
const menuOptions = ref<MenuOptions>({});

const loading = ref(false);
const user = ref<User>(null);
const pack = ref<Pack>(null);

const menuClick = function (e: MouseEvent) {
    e.preventDefault();
    menuOptions.value = {
        x: e.x,
        y: e.y,
        theme: 'default tg',
        direction: 'bl',
    };
    menuOpen.value = true;
}

const setScheme = () => {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
};

const loadUser = async () => {
    try {
        const response = await axios.get(route('webapp.user'), {
            params: {
                initData: webapp.initData,
            },
        });
        user.value = response.data;
    } catch (e) {
    }
};

const addPack = async () => {
    if (user.value === null) {
        showPopup({
            message: trans('inline.not_started'),
            buttons: [
                {type: 'default', text: trans('common.open'), id: 'open'},
                {type: 'cancel'},
            ],
        }, function (id: string) {
            if (id === 'open') {
                openTelegramLink('https://t.me/' + appData.bot_username);
            }
        });
        return;
    }

    await axios.post(route('webapp.pack.add', {pack: pack.value.id}), {
        initData: webapp.initData,
    });
};

const removePack = async () => {
    await axios.post(route('webapp.pack.remove', {pack: pack.value.id}), {
        initData: webapp.initData,
    });
};

const handlePack = async () => {
    loading.value = true;
    if (pack.value.installed) {
        await removePack();
    } else {
        await addPack();
    }
    await loadPack();
    loading.value = false;
};

const loadPack = async () => {
    try {
        const packCode = webapp.initDataUnsafe.start_param;
        const response = await axios.get(route('webapp.pack', {pack: packCode}), {
            params: {
                initData: webapp.initData,
            },
        });
        pack.value = response.data;
    } catch (e) {
    }
};

const packButtonLabel = computed(() => {
    if (pack.value.installed) {
        return trans_choice('webapp.remove_stickers', pack.value.stickers_count);
    } else {
        return trans_choice('webapp.add_stickers', pack.value.stickers_count);
    }
});

const sharePack = () => switchInlineQuery(`§${pack.value.code}`, ['users', 'groups', 'channels', 'bots']);

watch(user, (newUser) => {
    if (newUser) {
        loadLanguageAsync(newUser.language ?? 'en');
    }
});

onMounted(async () => {
    setScheme();
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.setHeaderColor('#056104');
    webapp.expand();
    await loadUser();
    await loadPack();
    webapp.ready();
});
</script>

<template>
    <context-menu v-model:show="menuOpen" :options="menuOptions">
        <context-menu-item :label="trans('common.share')" @click="sharePack">
            <template #icon>
                <font-awesome-icon icon="fa-solid fa-share"/>
            </template>
        </context-menu-item>
        <context-menu-item :label="trans('common.copy_link')" @click="copy(pack.share_url)">
            <template #icon>
                <font-awesome-icon icon="fa-solid fa-link" />
            </template>
        </context-menu-item>
    </context-menu>


    <MainButton
            v-if="pack"
            :progress="loading"
            :text="packButtonLabel"
            :text-color="pack.installed?(colors.red[500]):(colors.white)"
            :color="pack.installed?webapp.themeParams.bg_color:webapp.themeParams.button_color"
            @click="handlePack"
    />
    <MainButton
            v-else
            :text="trans('common.exit')"
            :text-color="colors.red[500]"
            :color="webapp.themeParams.bg_color"
            @click="webapp.close()"
    />

    <div class="h-full p-3" :class="{PackFound:pack}">
        <div v-if="pack">
            <div class="flex">
                <h1 class="flex-1 text-xl mb-3 ">{{ pack.name }}</h1>
                <button @click="menuClick" class="h-full px-3 aspect-square rounded-full">
                    <font-awesome-icon icon="fa-solid fa-ellipsis-vertical" class="text-tg-hint"/>
                </button>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="sticker in pack.stickers" :url="sticker.thumbnail"/>
            </div>
        </div>
        <div class="flex items-center justify-center h-full" v-else>
            <div class="text-center text-tg-hint">
                <font-awesome-icon icon="fa-regular fa-face-sad-tear" class="text-6xl"/>
                <p class="text-xl my-5">{{ trans('webapp.no_pack') }}</p>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
body {
    @apply bg-tg-bg;
}

.mx-context-menu.default.tg{
    @apply bg-tg-bg-400;

    .label, .mx-icon-placeholder{
        @apply text-tg-text;
    }

    .mx-context-menu-item{
        @apply hover:bg-tg-bg-300;
    }
}
</style>

<style scoped lang="scss">

</style>
