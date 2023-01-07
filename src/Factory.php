<?php

namespace tp5er\think\redis;

use Predis\Client;

class Factory
{
    /**
     * @param array $config
     * @return Client
     */
    public function make(array $config)
    {
        return $this->buildClient($config);
    }
    /**
     * @param array $config
     * @return Client
     */
    public function buildClient(array $config)
    {
        return new Client($config['parameters'], $config['options']);
    }
}