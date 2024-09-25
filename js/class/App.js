export class App {

    static #INSTANCE;

    settingsManager;

    constructor(settingsManager) {
        this.settingsManager = settingsManager;
    }

    static initialize(settingsManager) {
        App.#INSTANCE = new App(settingsManager);
    }

    static get() {
        if(!App.#INSTANCE)
            App.initialize();

        return App.#INSTANCE
    }

    static getSettingsManager() {
        return App.#INSTANCE.settingsManager;
    }

}