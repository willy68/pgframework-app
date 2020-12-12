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
use Framework\Auth\Repository\UserRepositoryInterface;
use Framework\Auth\RememberMe\RememberMe;
use Framework\Auth\RememberMe\RememberMeInterface;
use Framework\Auth\Service\UtilToken;
use Framework\Auth\Service\UtilTokenInterface;

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
    UtilTokenInterface::class => \DI\get(UtilToken::class),
    UserRepositoryInterface::class => \DI\get(ActiveRecordUserRepository::class),
    ForbidenMiddleware::class => \DI\autowire()->constructorParameter('loginPath', \DI\get('auth.login'))
];
