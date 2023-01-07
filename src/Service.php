<?php

namespace tp5er\think\redis;


use Predis\Client;


class Service extends \think\Service
{
    public function register()
    {
        $this->app->bind('redis.factory', Factory::class);

        $this->app->bind('redis', function () {
            return new Manager($this->app, $this->app['redis.factory']);
        });

        $this->app->bind(Client::class, function () {
            return $this->app->make('redis')->connection();
        });
    }
}