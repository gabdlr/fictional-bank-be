<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$container = require_once __DIR__ . '/app/DI-container.php';

return ConsoleRunner::createHelperSet($container->get(EntityManager::class));