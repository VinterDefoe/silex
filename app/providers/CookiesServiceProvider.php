<?php

namespace App\Providers;


use Pimple\Container;
use Pimple\ServiceProviderInterface;


class CookiesServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['cookies'] = function () {
            return "hello";
        };
    }
}




