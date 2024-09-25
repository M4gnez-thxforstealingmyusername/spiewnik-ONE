import { Settings } from "../class/Settings.js";
import { CookieService } from "../service/CookieService.js";
import { SettingsService } from "../service/SettingsService.js";

export class SettingsManager{

    #settings;

    constructor() {
        this.getRemoteSettings().then(() => {this.apply()});
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

    apply() {
        this.setTheme(this.#settings.getTheme())
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

    setDefaultLocalSettings() {
        console.info("info:\n\tno settings found, initializing default settings");

        document.cookie = "settings=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        const expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (30*24*60*60*1000));
        document.cookie = `settings=${Settings.getDefault().serialize()};expires=${expirationDate.toUTCString()};path=/`;
    }

    setTheme(theme) {
        let themeSheet = document.getElementById("themeSheet");

        //TODO: create theme list and check if present
        if(true){
            themeSheet.setAttribute("href", `${theme}.css`);
            console.info(`info:\n\ttheme set to: "${theme}"`);
        }
        else
            console.warn(`warning:\n\ttheme not found`)
    }
}