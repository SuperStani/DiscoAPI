<?php

$container = require_once  __DIR__ . "/../bootstrap.php";

$app = $container->get(\DiscoAPI\Core\Services\EventsService::class);
if($app->updateEventsFile()) {
    echo "EVENTI AGGIORNATI\n";
} else {
    echo "EVENTI NON AGGIORNATI";
}