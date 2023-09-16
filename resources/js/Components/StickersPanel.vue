<script setup lang="ts">
import route from "ziggy-js";
import BetterImage from "@/Components/BetterImage.vue";
import {computed, ref, watch} from "vue";
import {trans} from 'laravel-vue-i18n';
import debounce from "lodash.debounce";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import { vOnLongPress } from '@vueuse/components';

interface Props {
    search: string;
    text: string;
    favorites: any[];
    history: any[];
    packs: any[];
}

const searchResult = ref([]);

const props = defineProps<Props>();
defineEmits(['send', 'sendFromHistory', 'clearHistory', 'clearFavorites', 'menu', 'removePack']);

const loadSearch = async () => {
  const response = await axios.get(route('webapp.search'), {
    params: {
      user_id: window.initData.user_id,
      fingerprint: window.initData.fingerprint,
      search: props.search,
    }
  });
  searchResult.value = response.data;
};

watch(() => props.search, debounce(() => {
  loadSearch();
}, 800));

const hasHistory = computed(() => props.history.length > 0);
const hasFavorites = computed(() => props.favorites.length > 0);
const hasPacks = computed(() => props.packs.length > 0);
</script>

<template>
    <div class="bg-tg-bg" :class="{'h-full': !hasFavorites && !hasHistory && ((!search && !hasPacks) || (search && searchResult.length===0))}">

        <!-- FAVORITE -->
        <div class="pb-2 mb-2" v-if="hasFavorites && !search">
            <div class="flex mb-2">
                <a id="favorites" class="flex-auto text-tg-hint font-semibold text-sm block cursor-default" style="scroll-margin-top: 50px;">
                    {{ trans('webapp.favorite.title') }}
                </a>
                <button @click="$emit('clearFavorites')" class="inline-block">
                    <font-awesome-icon icon="fa-solid fa-xmark" class="text-tg-hint"/>
                </button>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="item in favorites"
                             :is-template="!item.text"
                             :url="route('webapp.sticker.preview', {sticker: item.sticker_id, text: item.text ?? text})"
                             @click="$emit('sendFromHistory', {sticker: item.sticker_id, text: item.text ?? text});"
                             v-on-long-press.prevent="()=>$emit('menu', {mode:'removeFavorite', favorite_id: item.id, sticker: item.sticker_id, text: item.text ?? text})"
                             @contextmenu.prevent="$emit('menu', {mode:'removeFavorite', favorite_id: item.id, sticker: item.sticker_id, text: item.text ?? text});"
                />
            </div>
        </div>

        <!-- HISTORY -->
        <div class="pb-2 mb-2" v-if="hasHistory && !search">
            <div class="flex mb-2">
                <a id="history" class="flex-auto text-tg-hint font-semibold text-sm block cursor-default" style="scroll-margin-top: 50px;">
                    {{ trans('webapp.history') }}
                </a>
                <button @click="$emit('clearHistory')" class="inline-block">
                    <font-awesome-icon icon="fa-solid fa-xmark" class="text-tg-hint"/>
                </button>
            </div>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="item in history"
                             :url="route('webapp.sticker.preview', {sticker: item.sticker_id, text: item.text})"
                             @click="$emit('sendFromHistory', {sticker: item.sticker_id, text: item.text});"
                             v-on-long-press.prevent="()=>$emit('menu', {mode: 'default', sticker: item.sticker_id, text: item.text})"
                             @contextmenu.prevent="$emit('menu', {mode: 'default', sticker: item.sticker_id, text: item.text});"
                />
            </div>
        </div>

        <!-- NO STICKERS FOUND -->
        <div class="flex items-center justify-center h-full" v-if="(!search && !hasPacks) || (search && searchResult.length===0)">
            <div class="text-center text-tg-hint">
                <font-awesome-icon icon="fa-regular fa-face-sad-tear" class="text-6xl"/>
                <p class="text-xl mt-5">{{ trans('webapp.no_sticker') }}</p>
                <p class="text-xs" v-if="!search && !hasPacks">
                    <font-awesome-icon icon="fa-solid fa-boxes-stacked" class="text-tg-hint"/>
                    {{ trans('webapp.open_store') }}
                </p>
            </div>
        </div>

        <!-- SEARCH -->
        <div v-if="search && searchResult.length>0">
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="sticker in searchResult"
                             :key="`ss${sticker.id}`"
                             :url="route('webapp.sticker.preview', {sticker: sticker.id, text: text})"
                             @click="$emit('send', sticker.id);"
                             v-on-long-press.prevent="()=>$emit('menu', {mode: 'default', sticker: sticker.id, text: text})"
                             @contextmenu.prevent="$emit('menu', {mode: 'default', sticker: sticker.id, text: text});"
                />
            </div>
        </div>

        <!-- STICKERS -->
        <div v-if="!search" v-for="pack in packs" :key="`p${pack.id}`" class="pb-2 mb-2">
            <div class="flex mb-2">
                <a :id="`P${pack.id}`" class="flex-auto text-tg-hint font-semibold text-sm block cursor-default"
                   style="scroll-margin-top: 50px;">
                    {{ pack.name }}
                </a>
                <button @click="$emit('removePack', pack.id)" class="inline-block">
                    <font-awesome-icon icon="fa-solid fa-xmark" class="text-tg-hint"/>
                </button>
            </div>
            <p class="italic text-sm text-tg-hint" v-if="pack.stickers.length===0">{{trans('webapp.no_sticker')}}</p>
            <div class="grid grid-cols-4 gap-2">
                <BetterImage v-for="sticker in pack.stickers"
                             :key="`s${sticker.id}`"
                             :url="route('webapp.sticker.preview', {sticker: sticker.id, text: text})"
                             @click="$emit('send', sticker.id);"
                             v-on-long-press.prevent="()=>$emit('menu', {mode: 'default', sticker: sticker.id, text: text})"
                             @contextmenu.prevent="$emit('menu', {mode: 'default', sticker: sticker.id, text: text});"
                />
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.v-progressive-image {
    background: none;
}

.selectedSticker {
    box-shadow: 0 0 0 2px var(--tg-theme-link-color);
    border: 2px solid var(--tg-theme-bg-color);
}

.sticker {
    cursor: pointer;

    &:hover {
        box-shadow: 0 0 0 2px var(--tg-theme-link-color);
        border: 2px solid var(--tg-theme-bg-color);
    }
}
</style>
