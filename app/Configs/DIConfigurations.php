<?php

use \DiscoAPI\Configs\GeneralConfigurations;
use \DiscoAPI\Configs\RedisConfigurations;
use \DiscoAPI\Configs\DatabaseCredentials;
use \DiscoAPI\Core\Controllers\RedisController;
use \DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\Logger\Logger;
use \DiscoAPI\Core\ORM\DB;

use \GuzzleHttp\Client;
use \Psr\Container\ContainerInterface;
use function DI\factory;

return [
    LoggerInterface::class => factory(function (ContainerInterface $c) {
        return new Logger();
    }),
    DB::class => factory(function (ContainerInterface $c) {
        return new DB(
            $c->get(LoggerInterface::class),
            DatabaseCredentials::HOST,
            DatabaseCredentials::PORT,
            DatabaseCredentials::USER,
            DatabaseCredentials::PASSWORD,
            DatabaseCredentials::DATABASE
        );
    }),
    /*RedisController::class => factory(function () {
        return new RedisController(
            RedisConfigurations::HOST,
            RedisConfigurations::PORT,
            RedisConfigurations::SOCKET
        );
    })*/
];