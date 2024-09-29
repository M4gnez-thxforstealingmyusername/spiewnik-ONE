//default (public) User class

export class User{

    #id;
    #cityId;
    #joinDate;
    #username;
    #displayName;
    #authorizationLever;

    getId() {
        return this.#id;
    }

    getCity() {
        return this.#cityId;
    }

    getJoinDate() {
        return this.#joinDate;
    }

    getUsername() {
        return this.#username;
    }

    getDisplayName() {
        return this.#displayName;
    }

    getAuthorizationLevel() {
        return this.#authorizationLever;
    }

    setId(value) {
        this.#id = value;
    }

    setCityId(value) {
        this.#cityId = value;
    }

    setJoinDate(value) {
        this.#joinDate = value;
    }

    setDisplayname(value) {
        this.#displayName = value;
    }

    setAuthorizationLevel(value) {
        this.#authorizationLever = value;
    }
}