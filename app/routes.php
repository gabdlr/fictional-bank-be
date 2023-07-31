<?php

declare(strict_types=1);

use App\Application\Actions\ProductoFinanciero\CreateProductoFinancieroAction;
use App\Application\Actions\ProductoFinanciero\ListProductosFinancierosAction;
use App\Application\Actions\ProductoFinanciero\VerifyProductoFinancieroAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Middleware\JsonBodyParserMiddleware;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/bp/products', function (Group $group) {
        $group->get('', ListProductosFinancierosAction::class);
        $group->post('', CreateProductoFinancieroAction::class)->addMiddleware(new JsonBodyParserMiddleware());
        $group->get('/verification', VerifyProductoFinancieroAction::class);
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
