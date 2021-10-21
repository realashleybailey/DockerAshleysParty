<?php

use Ashley\Library\DotEnv;

DotEnv::LoadDefault();

define("SITE_NAME", str_replace('_', ' ', $_ENV['SITE_NAME']));
define("FIREBASE_CONFIG", realpath(__DIR__ . '/../../config/firebase_credentials.json'));
