<?php

namespace tp5er\think\redis;

use InvalidArgumentException;
use Predis\Client;
use think\App;
use think\helper\Arr;

class Manager
{
    /**
     * @var App
     */
    protected $app;
    /**
     * @var Factory
     */
    protected $factory;
    /**
     * @var array
     */
    private $connections = [];

    /**
     * Manager constructor.
     * @param App $app
     * @param Factory $factory
     */
    public function __construct(App $app, Factory $factory)
    {
        $this->app     = $app;
        $this->factory = $factory;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function connection(string $name = null)
    {
        $name = $name ?: $this->getDefaultConnection();
        if (!isset($this->connections[$name])) {
            $client                   = $this->makeConnection($name);
            $this->connections[$name] = $client;
        }
        return $this->connections[$name];
    }

    /**
     * @return string
     */
    protected function getDefaultConnection()
    {
        return $this->app->config->get('redis.defaultConnection');
    }

    /**
     * @param string $name
     * @return Client
     */
    public function makeConnection(string $name)
    {
        $config = $this->getConfig($name);
        return $this->factory->make($config);
    }

    /**
     * @param string $name
     * @return array
     */
    protected function getConfig(string $name)
    {
        $connections = $this->app->config->get('redis.connections');
        if (null === $config = Arr::get($connections, $name)) {
            throw new InvalidArgumentException("redis connection [$name] not configured.");
        }
        return $config;
    }

    /**
     * @return array
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Dynamically pass methods to the default connection.
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return call_user_func_array([$this->connection(), $method], $parameters);
    }
}