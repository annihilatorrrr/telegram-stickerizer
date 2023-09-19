import {Telegram} from "@twa-dev/types"

declare global {
    interface InitData {
        user_id?: number;
        fingerprint?: string;
        text?: string;
        lang?: string;
        bot_username?: string;
    }

    interface Window {
        Telegram: Telegram;
        initData: InitData;
    }
}
