<?php
use DI\ContainerBuilder;

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
}

// Set up settings
$settings = require __DIR__ . '/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/repositories.php';
$repositories($containerBuilder);

// Set up doctrine
$doctrine = require __DIR__ . '/doctrine.php';
$doctrine($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

return $container;