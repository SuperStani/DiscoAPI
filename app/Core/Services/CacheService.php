<?php


namespace DiscoAPI\Core\Services;

use DiscoAPI\Configs\GeneralConfigurations;
use DiscoAPI\Core\Controllers\RedisController;

class CacheService
{
    private RedisController $redisController;

    public function __construct(RedisController $redisController)
    {
        $this->redisController = $redisController;
    }
}