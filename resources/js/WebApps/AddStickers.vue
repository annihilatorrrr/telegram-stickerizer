<script setup lang="ts">
import {MainButton, useWebAppPopup, useWebAppNavigation} from "vue-tg";
import {onMounted, ref, computed, watch} from "vue";
import axios from "axios";
import route from "ziggy-js";
import colors from 'tailwindcss/colors';
import User from "@/Types/User";
import Pack from "@/Types/Pack";
import {loadLanguageAsync, trans, trans_choice} from "laravel-vue-i18n";
import BetterImage from "@/Components/BetterImage.vue";

const {showAlert, showPopup} = useWebAppPopup();
const {openTelegramLink} = useWebAppNavigation();
const webapp = window.Telegram.WebApp;
const appData = window.initData;

const loading = ref(false);
const user = ref<User>(null);
const pack = ref<Pack>(null);

const setScheme = () => {
    if (webapp.platform === 'unknown') {
        document.body.setAttribute('data-scheme', 'dark');
    } else {
        document.body.setAttribute('data-scheme', webapp.colorScheme);
    }
};

const loadUser = async () => {
    try {
        const response = await axios.get(route('webapp.user', {user: webapp.initDataUnsafe.user.id}), {
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
                {type:'default', text: trans('common.open'), id: 'open'},
                {type:'cancel'},
            ],
        }, function(id:string){
            if(id==='open'){
                openTelegramLink('https://t.me/'+appData.bot_username);
            }
        });
        return;
    }

    await axios.post(route('webapp.pack.add', {pack: pack.value.id}), {
        initData: webapp.initData,
        user_id: webapp.initDataUnsafe.user.id,
    });
};

const removePack = async () => {
    await axios.post(route('webapp.pack.remove', {pack: pack.value.id}), {
        initData: webapp.initData,
        user_id: webapp.initDataUnsafe.user.id,
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
                user_id: webapp.initDataUnsafe.user.id,
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

watch(user, (newUser) => {
    if (newUser) {
        loadLanguageAsync(newUser.language ?? 'en');
    }
});

onMounted(async () => {
    setScheme();
    webapp.onEvent('themeChanged', () => setScheme());
    webapp.expand();
    await loadUser();
    await loadPack();
    webapp.ready();
});
</script>

<template>
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
            <h1 class="text-2xl mb-3">{{ pack.name }}</h1>
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
    //height: 100% !important;
}
</style>

<style scoped lang="scss">
</style>
