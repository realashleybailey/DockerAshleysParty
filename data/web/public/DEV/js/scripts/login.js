import { initializeApp } from "firebase/app";
import { getAuth, setPersistence, signInWithEmailAndPassword, inMemoryPersistence } from "firebase/auth";
import { fetchAPI } from "../modules/fetchAPI";
import { getCookie } from "../modules/getCookie";
import { isToday } from "../modules/isToday";

const firebaseConfig = {
    apiKey: "AIzaSyAQMiZ8f8zd0TYxOXsLHctJNTN6SO-nvCc",
    authDomain: "ashleys-party.firebaseapp.com",
    databaseURL: "https://ashleys-party-default-rtdb.firebaseio.com",
    projectId: "ashleys-party",
    storageBucket: "ashleys-party.appspot.com",
    messagingSenderId: "647467436170",
    appId: "1:647467436170:web:a14aa6d988cb4ad3994573",
    measurementId: "G-38T83Q0Z84"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth();

const firebaseError = {
    "auth/user-disabled": "Your account has been disabled, please contact a administrator.",
    "auth/wrong-password": "Password is incorrect, please try again.",
    "auth/user-not-found": "We could not find a user with that email, please try again.",
    "auth/invalid-email": "The email provided was incorrect, please try again."
}
window.error = firebaseError

class LoginPage {

    constructor() {
        this._init();
    }

    _init() {
        window.$ = $;
        const errorBox = $('#errorBox');
        const errorModal = new mdb.Modal(errorBox);

        const loadingBox = $('#loadingBox');
        const loadingModal = new mdb.Modal(loadingBox);

        const urlString = window.location.search
        const urlParams = new URLSearchParams(urlString);

        if (urlParams.get('error') != undefined && urlParams.get('error').length > 0) {
            errorBox.find('.bodytext').text(urlParams.get('error'));
            errorModal.show();
        }

        if (urlParams.get('errormsg') != undefined && urlParams.get('errormsg').length > 0) {
            $("#errorMessage").html(urlParams.get('errormsg'));
            $("#errorMessage").show();
        }

        $(".form-signin").on("submit", function (event) {
            event.preventDefault()
            loadingModal.show();

            var email = $(".form-signin #inputEmail").val();
            var password = $(".form-signin #inputPassword").val()
            var remember = $("#rememberMe").checked;

            setPersistence(auth, inMemoryPersistence)

            signInWithEmailAndPassword(auth, email, password)
                .then((userCredentials) => {
                    const user = userCredentials.user

                    user.getIdToken().then(idToken => {
                        const csrfToken = getCookie('CSRFtoken')

                        var bodyParameters = {
                            "CSRFtoken": csrfToken,
                            "idToken": idToken
                        }

                        fetchAPI(bodyParameters, '/Authentication/Login', 'POST')
                            .then((data) => {

                                const lastLogin = new Date(data.metadata.lastLoginAt);
                                const modalBox = {
                                    modalTitle: "Welcome back " + data.displayName,
                                    modalMessage: "Welcome back to Ashleys Party",
                                    modalBox: !isToday(lastLogin)
                                }

                                const d = new Date();
                                d.setTime(d.getTime() + (3600 * 1000));
                                let expires = d.toUTCString();

                                document.cookie = "login=" + idToken + "; expires=" + expires + "; path=/";

                                const redirectPage = urlParams.get('page') ? urlParams.get('page') : '';
                                window.location.assign(window.location.origin + redirectPage + '?' + $.param(modalBox));
                            })
                            .catch((error) => {
                                loadingModal.hide();

                                errorBox.find('.modal-title').text(error.type);
                                errorBox.find('.bodytext').text(error.message);

                                errorModal.show();
                            })
                    })
                })
                .catch((error) => {

                    loadingModal.hide();

                    $("#errorMessage").html(firebaseError[error.code] != undefined ? firebaseError[error.code] : "There was an error attempting to sign you in, please try again or contact an administrator.");
                    $("#errorMessage").show();

                    console.log(error.code + ": " + error.message);
                })

            return false;
        });
    }
}

export default LoginPage;