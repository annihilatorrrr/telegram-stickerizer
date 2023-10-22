<script setup lang="ts">
import '@css/webapp.scss';
import {MainButton, BackButton} from "vue-tg";
import {computed, onMounted, ref, watch} from "vue";
import axios from "axios";
import route from "ziggy-js";
import colors from 'tailwindcss/colors';
import Me from "@/Types/Me";
import User from "@/Types/User";
import Pack from "@/Types/Pack";
import {loadLanguageAsync, trans, trans_choice} from "laravel-vue-i18n";
import BetterImage from "@/Components/BetterImage.vue";
import {ContextMenu, ContextMenuItem, type MenuOptions} from '@imengyu/vue3-context-menu';
import {useClipboard} from '@vueuse/core';
import WebApp from '@twa-dev/sdk';

interface Props {
    initData?: string;
    packCode: number;
    canGoBack: boolean;
}
const props = defineProps<Props>();

const { copy } = useClipboard();
const menuOpen = ref(false);
const menuOptions = ref<MenuOptions>({});

const loading = ref(false);
const me = ref<Me>(null);
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
    if (WebApp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', WebApp.colorScheme);
    }
};

const loadMe = async () => {
    try {
        const response = await axios.get(route('webapp.me'), {
            params: {
                initData: WebApp.initData || props.initData,
            },
        });
        me.value = response.data;
    } catch (e) {
        console.log(e);
    }
};

const loadUser = async () => {
    try {
        const response = await axios.get(route('webapp.user'), {
            params: {
                initData: WebApp.initData || props.initData,
            },
        });
        user.value = response.data;
    } catch (e) {
        console.log(e);
    }
};

const loadPack = async () => {
    try {
        const response = await axios.get(route('webapp.pack', {pack: props.packCode}), {
            params: {
                initData: WebApp.initData || props.initData,
            },
        });
        pack.value = response.data;
    } catch (e) {
        console.log(e);
    }
};

const addPack = async () => {
    if (user.value === null) {
        WebApp.showPopup({
            message: trans('inline.not_started'),
            buttons: [
                {type: 'default', text: trans('common.open'), id: 'open'},
                {type: 'cancel'},
            ],
        }, function (id: string) {
            if (id === 'open') {
                WebApp.openTelegramLink('https://t.me/' + me.value.botName);
            }
        });
        return;
    }

    await axios.post(route('webapp.pack.add', {pack: pack.value.id}), {
        initData: WebApp.initData,
    });
};

const removePack = async () => {
    await axios.post(route('webapp.pack.remove', {pack: pack.value.id}), {
        initData: WebApp.initData,
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

const packButtonLabel = computed(() => {
    if (pack.value.installed) {
        return trans_choice('webapp.remove_stickers', pack.value.stickers_count);
    } else {
        return trans_choice('webapp.add_stickers', pack.value.stickers_count);
    }
});

const sharePackUrl = () => {
    WebApp.switchInlineQuery(`§${pack.value.code}`, ['users', 'groups', 'channels', 'bots']);
};

const copyPackUrl = () => {
    copy(pack.value.share_url);
};

const goBack = () => window.history.back();

watch(user, (newUser) => {
    if (newUser) {
        loadLanguageAsync(newUser.language ?? 'en');
    }
});

onMounted(async () => {
    setScheme();
    await loadMe();
    await loadUser();
    await loadPack();
    WebApp.onEvent('themeChanged', () => setScheme());
    WebApp.setHeaderColor('#056104');
    WebApp.expand();
    WebApp.ready();
});
</script>

<template>
    <context-menu v-model:show="menuOpen" :options="menuOptions">
        <context-menu-item :label="trans('common.share')" @click="sharePackUrl">
            <template #icon>
                <font-awesome-icon icon="fa-solid fa-share"/>
            </template>
        </context-menu-item>
        <context-menu-item :label="trans('common.copy_link')" @click="copyPackUrl">
            <template #icon>
                <font-awesome-icon icon="fa-solid fa-link" />
            </template>
        </context-menu-item>
    </context-menu>

    <BackButton :visible="props.canGoBack" @click="goBack"/>

    <MainButton
            v-if="pack"
            :progress="loading"
            :text="packButtonLabel"
            :text-color="pack.installed?(colors.red[500]):(colors.white)"
            :color="pack.installed?WebApp.themeParams.bg_color:WebApp.themeParams.button_color"
            @click="handlePack"
    />
    <MainButton
            v-else
            :text="trans('common.exit')"
            :text-color="colors.red[500]"
            :color="WebApp.themeParams.bg_color"
            @click="WebApp.close()"
    />

    <div class="h-full p-3" :class="{PackFound:pack}">
        <div v-if="pack">
            <div class="flex">
                <div class="flex-1 mb-3 flex flex-col">
                    <h1 class="text-xl">{{ pack.name }}</h1>
                    <p class="text-tg-hint text-xs">
                        {{ trans_choice('webapp.sticker_count', pack.stickers_count) }} |
                        {{ trans_choice('common.install_count', pack.install_count) }}
                    </p>
                </div>
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
