<?php

use Middlewares\Whoops;
use GuzzleHttp\Psr7\ServerRequest;

use function Http\Response\send;

$basePath = dirname(__DIR__);

putenv("ENV=dev");

putenv('JWT_SECRET=MasuperPhraseSecrete');

require $basePath . '/vendor/autoload.php';

$bootstrap = require $basePath . '/app/Bootstrap/Bootstrap.php';

$app = (new Framework\App(
    [
        $basePath . '/config/config.php',
        $basePath . '/config/database.php'
    ]
))
    ->addModules($bootstrap['modules']);

$container = $app->getContainer();

if (getenv('env') === 'dev') {
    $app->pipe(Whoops::class);
}

$app->middlewares($bootstrap['middlewares']);

if (php_sapi_name() !== 'cli') {
    $response = $app->run(ServerRequest::fromGlobals());
    send($response);
}
