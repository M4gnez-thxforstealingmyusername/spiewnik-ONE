export class UserSettings{
    static #DEFAULT = new Map([["theme", "lightTheme.css"]])


    getRemoteSettings() {
        //check database for changes in settings
    }

    setRemoteSettings() {
        
    }

    apply() {
        //apply settings
    }

    getLocalSettings() {
        //check cookies for settings
    }

    setDefaultLocalSettings() {
        const expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (30*24*60*60*1000));
        document.cookie = `settings=${UserSettings.#DEFAULT};expires=${expirationDate.toUTCString()};path=/`;
    }

    switchTheme() {
        let themeSheet = document.getElementById("themeSheet");

        if(themeSheet.getAttribute("href") !== "darkTheme.css") {
            themeSheet.setAttribute("href", "darkTheme.css");
            console.log("Theme set to: \"darkTheme.css\"");
        }
        else {
            themeSheet.setAttribute("href", "lightTheme.css");
            console.log("Theme set to: \"lightTheme.css\"");
        }
    }

    setTheme(theme) {
        let themeSheet = document.getElementById("themeSheet");

        if(/.*Theme\.css/.test(theme)){
            themeSheet.setAttribute("href", theme);
            console.log(`Theme set to: "${theme}"`);
        }
        else
            console.warn(`Warning:\n\tinvalid theme file format:\n\t  "${theme}",\n\texpected:\n\t  "...Theme.css"`)
    }

}