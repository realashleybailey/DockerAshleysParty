import { initializeApp } from "firebase/app";
import { getAuth, signInWithPopup, getRedirectResult, GoogleAuthProvider } from "firebase/auth";

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

const provider = new GoogleAuthProvider();

window.adminLogin = function () {
    signInWithPopup(auth, provider)
        .then((result) => {
            // This gives you a Google Access Token. You can use it to access the Google API.
            const credential = GoogleAuthProvider.credentialFromResult(result);
            const token = credential.accessToken;
            // The signed-in user info.

            const user = result.user;
            // ...
            console.log(token)
            console.log(user)
        }).catch((error) => {
            // Handle Errors here.
            const errorCode = error.code;
            const errorMessage = error.message;
            // The email of the user's account used.
            const email = error.email;
            // The AuthCredential type that was used.
            const credential = GoogleAuthProvider.credentialFromError(error);
            // ...
        });

}

getRedirectResult(auth)
    .then((result) => {
        // This gives you a Google Access Token. You can use it to access Google APIs.
        const credential = GoogleAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;

        // The signed-in user info.
        const user = result.user;
        console.log(token)
        console.log(user)
    }).catch((error) => {
        // Handle Errors here.
        const errorCode = error.code;
        const errorMessage = error.message;
        // The email of the user's account used.
        const email = error.email;
        // The AuthCredential type that was used.
        const credential = GoogleAuthProvider.credentialFromError(error);
        // ...
    });