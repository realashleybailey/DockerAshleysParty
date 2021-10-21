<?php

namespace Ashley\Library;

class DotEnv
{
    static function LoadDefault()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(realpath(__DIR__ . '/../../config/'), 'server.env');
        $dotenv->load();
    }
}
