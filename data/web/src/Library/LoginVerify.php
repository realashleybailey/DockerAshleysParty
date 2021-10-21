<?php

use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;

function VerifyLogin()
{
    $idTokenString = isset($_COOKIE['login']) ? $_COOKIE['login'] : "";

    try {
        $factory         = (new Factory)->withServiceAccount(__DIR__ . '/../config/firebase_credentials.json');
        $auth            = $factory->createAuth();
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        $uid = $verifiedIdToken->claims()->get('sub');
        $user = $auth->getUser($uid);
    } catch (InvalidToken | \InvalidArgumentException $e) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'login.php';
        $error = urlencode($e->getMessage());
        header("Location: http://$host$uri/$extra?error=$error&page=$uri");
        exit;
    }
}
