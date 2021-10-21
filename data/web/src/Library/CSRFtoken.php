<?php

namespace Ashley\Library;

class CSRFtoken
{
    static function Generate()
    {
        if (empty($_SESSION['CSRFtoken'])) {
            $TOKEN = bin2hex(random_bytes(32));
            $_SESSION['CSRFtoken'] = $TOKEN;
            setcookie("CSRFtoken", $TOKEN, time() + 3600);
        } else {
            $TOKEN = $_SESSION['CSRFtoken'];
            setcookie("CSRFtoken", $TOKEN, time() + 3600);
        }

        return $TOKEN;
    }
}
