import Sticker from "./Sticker";

export default interface Pack {
    id: number;
    name: string;
    code: string;
    icon: string;
    share_url: string;
    stickers_count: number;
    stickers: Sticker[];
    installed?: boolean;
}
