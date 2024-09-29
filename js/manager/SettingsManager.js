import { Settings } from "../class/Settings.js";
import { CookieService } from "../service/CookieService.js";
import { SettingsService } from "../service/SettingsService.js";

export class SettingsManager{

    #settings;

    constructor() {
        this.getRemoteSettings();
    }

    async getRemoteSettings() {
        await new SettingsService().get().then(data => {
            if(JSON.parse(data))
                this.#settings = new Settings(JSON.parse(data));
        })

        if(this.#settings)
            console.info("info:\n\tremote settings loaded");
        else {
            console.info("info:\n\tremote settings not found");
            this.getLocalSettings();
        }
    }

    setRemoteSettings() {
        return 1;
    }

    async getLocalSettings() {
        if(this.#settings)
            return;

        if(document.cookie.includes("settings")) {
            this.#settings = new Settings(JSON.parse(new CookieService("settings").get()));
            console.info("info:\n\tlocal settings loaded");
        }
        else {
            console.info("info:\n\tlocal settings not found");
            this.setDefaultLocalSettings();
        }
    }

    setLocalSettings() {
        document.cookie = "settings=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

        const expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (30*24*60*60*1000));
        document.cookie = `settings=${this.#settings.serialize()};expires=${expirationDate.toUTCString()};path=/`;

        console.info("info:\n\tlocal settings saved");
    }

    setDefaultLocalSettings() {
        console.info("info:\n\tno settings found, initializing default settings");

        this.#settings = Settings.getDefault();

        this.setLocalSettings();
    }
XS
}