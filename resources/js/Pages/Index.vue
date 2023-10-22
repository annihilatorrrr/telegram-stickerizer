<script setup lang="ts">
import {Head} from '@inertiajs/vue3';

defineProps({
    appName: String,
    botName: String,
    appVersion: String,
});
</script>

<template>
    <Head :title="appName" />
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <img src="../../img/banner.png" class="max-h-28" alt="banner">
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div class="h-16 w-16 bg-stickerizer-50 dark:bg-stickerizer-800/20 flex items-center justify-center rounded-full">
                                <font-awesome-icon icon="fa-solid fa-info" class="text-stickerizer-400" />
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Description</h2>

                            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                This bot let's you create stickers on the fly, via Telegram Mini App.<br/>
                                <br/>
                                Express yourself like never before with Stickerizer, a powerful Mini App that lets you create custom stickers on the go.
                                Once you’ve created the perfect sticker, don’t forget to add it to your favorites! Personalize your chats with stickers that are uniquely you.
                            </p>
                        </div>
                    </div>

                    <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div class="h-16 w-16 bg-stickerizer-50 dark:bg-stickerizer-800/20 flex items-center justify-center rounded-full">
                                <font-awesome-icon icon="fa-solid fa-code" class="text-stickerizer-400" />
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">About</h2>

                            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                Name: {{ appName }}
                            </p>
                            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                Username: <a :href="`https://t.me/${botName}`" class="underline">@{{ botName }}</a>
                            </p>
                            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm">
                                Version: v{{ appVersion }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
