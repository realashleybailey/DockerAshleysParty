import { fetchAPI } from "../modules/fetchAPI";

class Authentication {
    Signout() {
        window.location.assign(window.location.origin + '/api/Authentication/Logout');
    }
}

export default Authentication