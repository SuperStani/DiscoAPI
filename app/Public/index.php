<?php

$container = require_once __DIR__ . "/../bootstrap.php";

$api = $container->get(\DiscoAPI\Core\Controllers\APIController::class);

$api->init();
$api->process();
$api->response();