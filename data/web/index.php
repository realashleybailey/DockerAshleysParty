<?php

use Ashley\Library\DotEnv;

session_start();
require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 'On');

DotEnv::LoadDefault();

echo file_get_contents("../config/firebase_credentials.json");
