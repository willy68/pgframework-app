<?php

namespace App\Bootstrap;

use App\Api\ApiModule;
use App\Demo\DemoModule;
use App\Admin\AdminModule;
use App\Api\ApiClientModule;
use Framework\Middleware\MethodMiddleware;
use Framework\Middleware\RouterMiddleware;
use Framework\Middleware\ApiHeadMiddleware;
use Framework\Middleware\ApiOptionsMiddleware;
use Framework\Middleware\DispatcherMiddleware;
use Framework\Middleware\PageNotFoundMiddleware;
use Framework\Middleware\TrailingSlashMiddleware;
use Framework\Middleware\MethodNotAllowedMiddleware;

return [
    'modules' => [
        DemoModule::class,
        AdminModule::class,
        ApiModule::class,
        ApiClientModule::class
    ],
    'middlewares' => [
        TrailingSlashMiddleware::class,
        MethodMiddleware::class,
        RouterMiddleware::class,
        ApiHeadMiddleware::class,
        ApiOptionsMiddleware::class,
        MethodNotAllowedMiddleware::class,
        DispatcherMiddleware::class,
        PageNotFoundMiddleware::class
    ]
];