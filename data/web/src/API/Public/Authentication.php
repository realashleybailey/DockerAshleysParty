<?php

namespace Ashley\API\PublicAPI;

use Exception;
use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;

class Authentication
{
    static function Verify()
    {
        try {
            if (empty($_SESSION['login'])) {
                throw new Exception('Please login to continue.', 946);
            }

            $idTokenString = $_SESSION['login'];

            $factory         = (new Factory)->withServiceAccount(FIREBASE_CONFIG);
            $auth            = $factory->createAuth();
            $auth->verifyIdToken($idTokenString);
        } catch (InvalidToken | \InvalidArgumentException) {

            redirectWithError("You have been logged out automatically.");
            exit;
        } catch (Exception $e) {

            redirectWithError($e->getMessage());
            exit;
        }
    }


    static function Login($DATA)
    {
        session_start();

        if (empty($_SESSION['CSRFtoken']) || empty($DATA['CSRFtoken']) || $_SESSION['CSRFtoken'] != $DATA['CSRFtoken']) {
            throw new Exception("CSRF token invalid", 809);
        }

        $idTokenString = isset($DATA['idToken']) ? $DATA['idToken'] : "";

        $factory         = (new Factory)->withServiceAccount(FIREBASE_CONFIG);
        $auth            = $factory->createAuth();
        $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        $uid = $verifiedIdToken->claims()->get('sub');
        $user = $auth->getUser($uid);

        $_SESSION['login'] = $DATA['idToken'];
        $_SESSION['uid'] = $uid;

        echo json_encode($user);
    }

    static function getUser()
    {
        session_start();

        $factory         = (new Factory)->withServiceAccount(FIREBASE_CONFIG);
        $auth            = $factory->createAuth();
        $uid = $_SESSION['uid'];
        $user = $auth->getUser($uid);

        echo json_encode($user);
    }

    static function Logout()
    {
        session_start();
        session_destroy();

        $host  = $_SERVER['HTTP_HOST'];
        $extra = 'login.php';
        $error = urlencode('Logged out successfully');

        header("Location: http://$host/$extra?successmsg=$error");
    }
}


function redirectWithError($error)
{
    session_destroy();

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = $_SERVER['PHP_SELF'];
    $extra = 'login.php';
    $error = urlencode($error);
    header("Location: http://$host/$extra?errormsg=$error&page=$uri");
}
