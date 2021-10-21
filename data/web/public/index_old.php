<?php

use Firebase\Auth\Token\Exception\InvalidToken;
use Kreait\Firebase\Factory;

session_start();
require __DIR__ . '/../vendor/autoload.php';

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

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/assets/img/favicons/favicon.ico">

    <title>Index</title>

    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="text-center">

    <?php
    print_r($uid);
    ?>
    <script src="./js/index.js"></script>
    <button onclick="signOut()">Logout</button>
    <script>
        verifyLogin();
    </script>
</body>

</html>