<?php

use Framework\{
    Auth,
    Auth\AuthSession,
    Auth\User
};
use App\Auth\{
    ActiveRecordUserRepository,
    Twig\AuthTwigExtension,
    Middleware\ForbidenMiddleware
};
use Framework\Auth\Repository\UserRepository;
use Framework\Auth\RememberMe\RememberMe;
use Framework\Auth\RememberMe\RememberMeInterface;

use function DI\{
    add,
    get,
    factory
};

return [
    'auth.login' => '/login',
    'twig.extensions' => add([
        get(AuthTwigExtension::class)
    ]),
    Auth::class => \DI\get(AuthSession::class),
    User::class => factory(function (Auth $auth) {
        return $auth->getUser();
    })->parameter('auth', get(Auth::class)),
    RememberMeInterface::class => \DI\get(RememberMe::class),
    UserRepository::class => \DI\get(ActiveRecordUserRepository::class),
    ForbidenMiddleware::class => \DI\autowire()->constructorParameter('loginPath', \DI\get('auth.login'))
];
