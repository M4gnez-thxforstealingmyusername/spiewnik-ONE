export class Settings{

    #nextSlide;
    #reset;

    static #DEFAULT = new Settings({nextSlide: "left", reset: "r"});

    static getDefault() {
        return this.#DEFAULT;
    }

    constructor({nextSlide, reset}) {
        this.#nextSlide = nextSlide;
        this.#reset = reset;
    }

    //getters

    getNextSlide() {
        return this.#nextSlide;
    };

    getReset() {
        return this.#reset;
    };

    //setters

    setNextSlide(value) {
        this.#nextSlide = value;
    }

    setReset(value) {
        this.#reset = value;
    }

    serialize() {
        return JSON.stringify({nextSlide: this.#nextSlide, reset: this.#reset})
    }

}