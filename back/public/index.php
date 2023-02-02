<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;


require_once __DIR__ . "/../vendor/autoload.php";

$caminho = $_SERVER['PATH_INFO'];
$routes = require_once __DIR__ . "/../configs/routes.php";

if (!array_key_exists($caminho, $routes)) {
    http_response_code(404);
}

session_start();

$ehRotaLogin = stripos($caminho, 'login');
$ehRotaCadastro = stripos($caminho, 'cadastro');
if (!isset($_SESSION['logado']) && $ehRotaLogin === false && $ehRotaCadastro === false) {
    header('Location: /login');
    exit();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$classeControladora = $routes[$caminho];

/** @var ContainerInterface */
$container = require_once __DIR__ . "/../configs/dependencies.php";

/** @var RequestHandlerInterface */
$controlador = $container->get($classeControladora);

$resposta = $controlador->handle($request);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();
