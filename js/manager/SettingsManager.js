import { Settings } from "../class/Settings.js";

export class SettingsManager{

    #settings;

    constructor() {
        this.getLocalSettings();
    }

    getRemoteSettings() {
        //check database for changes in settings
    }

    setRemoteSettings() {
        return 1;
    }

    apply() {
        //apply settings
    }

    getLocalSettings() {
        if(document.cookie.includes("settings"))
            console.log(JSON.stringify(Settings.getDefault()));
        else
            console.log("settings missing");
        return 1;
    }

    setDefaultLocalSettings() {
        document.cookie = 'settings;expires=Thu, 01 Jan 1970 00:00:01 GMT"'
        const expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (30*24*60*60*1000));
        document.cookie = `settings=${JSON.stringify(Settings.getDefault())};expires=${expirationDate.toUTCString()};path=/`;
    }

    setTheme(theme) {
        let themeSheet = document.getElementById("themeSheet");

        if(/.*Theme\.css/.test(theme)){
            themeSheet.setAttribute("href", `${theme}Theme.css`);
            console.log(`Theme set to: "${theme}"`);
        }
        else
            console.warn(`Warning:\n\tinvalid theme file format:\n\t  "${theme}",\n\texpected:\n\t  "...Theme.css"`)
    }

}