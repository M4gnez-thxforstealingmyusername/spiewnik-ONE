export class Settings{

    #fontSize;
    #theme;
    #customColor;
    #nextSlide;
    #reset;

    static #DEFAULT = new Settings({fontSize: 16, theme: "defaultDark", customColor: null, nextSlide: "left", reset: "r"});

    static getDefault() {
        return this.#DEFAULT;
    }

    constructor({fontSize, theme, customColor, nextSlide, reset}) {
        this.#fontSize = fontSize;
        this.#theme = theme;
        this.#customColor = customColor;
        this.#nextSlide = nextSlide;
        this.#reset = reset;
    }

    //getters

    getFontSize() {
        return this.#fontSize;
    };

    getTheme() {
        return this.#theme;
    };

    getCustomColor() {
        return this.#customColor;
    };

    getNextSlide() {
        return this.#nextSlide;
    };

    getReset() {
        return this.#reset;
    };

    //setters

    setFontSize(value) {
        this.#fontSize = value;
    }

    setTheme(value) {
        this.#theme = value;
    }

    setCustomColor(value) {
        this.#customColor = value;
    }

    setNextSlide(value) {
        this.#nextSlide = value;
    }

    setReset(value) {
        this.#reset = value;
    }

    serialize() {
        return JSON.stringify({fontSize: this.#fontSize, theme: this.#theme, customColor: this.#customColor, nextSlide: this.#nextSlide, reset: this.#reset})
    }
}