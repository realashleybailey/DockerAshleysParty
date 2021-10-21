<?php

use FastRoute\RouteCollector;

require __DIR__ . '/../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
$whoops->register();


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addGroup('/api', function (RouteCollector $r) {
        $r->addRoute(['GET', 'POST'], '/private/{module}/{function}', "PrivateAPI");
        $r->addRoute(['GET', 'POST'], '/{module}/{function}', "PublicAPI");
    });
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header('Content-type: application/json');
        header('HTTP/1.0 404 Not Found');
        echo json_encode(['error' => ['message' => '404 Not Found']]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        header('Content-type: application/json');
        header('HTTP/1.0 400 Bad Request');
        $allowedMethods = $routeInfo[1];
        echo json_encode(['error' => ['message' => '400 Bad Request']]);
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $DATA = [];

        if (file_get_contents('php://input') != "") {
            $DATA = json_decode(file_get_contents('php://input'), true);
        }

        if (isset($_POST)) {
            $DATA += $_POST;
        }

        if (isset($_GET)) {
            $DATA += $_GET;
        }

        $classPath = "Ashley\\API\\" . $routeInfo[1] . "\\" . $routeInfo[2]['module'];
        $function = $routeInfo[2]['function'];

        if (!method_exists($classPath, $function)) {
            throw new Exception('API does not exist [' . $classPath . '::' . $function . ']');
        }

        $classPath::$function($DATA);

        break;
}
