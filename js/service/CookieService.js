export class CookieService {

    #cookie

    constructor(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2)
            this.#cookie = parts.pop().split(';').shift();
    }

    get() {
        return this.#cookie;
    }
}