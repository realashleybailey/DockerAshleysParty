import { getCookie } from "../modules/getCookie";

class DarkMode {
    constructor() {
        this._init();
    }

    _init() {
        const darkMode = getCookie('darkMode')

        if (darkMode == undefined) {
            document.cookie = "darkMode=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }

        if (darkMode == "false") {
            this.#darkFalse();
        }

    }

    #darkFalse() {
        $(".bg-dark").removeClass("bg-dark").addClass("bg-light");
        $(".navbar-dark").removeClass("navbar-dark").addClass("navbar-light");
        $(".text-light").removeClass("text-light").addClass("text-dark");
        $(".btn-dark").removeClass("btn-dark").addClass("btn-light");
        $("body").attr('style', 'background-color: #e4e4e4 !important');
    }

    #darkTrue() {
        $(".bg-light").removeClass("bg-light").addClass("bg-dark");
        $(".navbar-light").removeClass("navbar-light").addClass("navbar-dark");
        $(".text-dark").removeClass("text-dark").addClass("text-light");
        $(".btn-light").removeClass("btn-light").addClass("btn-dark");
        $("body").attr('style', 'background-color: #1b1c1e !important');
    }

    toggle() {
        const darkMode = getCookie('darkMode')

        if (darkMode == "false") {
            this.#darkTrue();
            document.cookie = "darkMode=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        } else {
            this.#darkFalse();
            document.cookie = "darkMode=false; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        }
    }

}

export default DarkMode;