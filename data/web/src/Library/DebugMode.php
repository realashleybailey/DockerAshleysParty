<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
