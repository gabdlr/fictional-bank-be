<?php

declare(strict_types=1);

use App\Application\Actions\ProductoFinanciero\CreateProductoFinancieroAction;
use App\Application\Actions\ProductoFinanciero\DeleteProductoFinancieroAction;
use App\Application\Actions\ProductoFinanciero\ListProductosFinancierosAction;
use App\Application\Actions\ProductoFinanciero\UpdateProductoFinancieroAction;
use App\Application\Actions\ProductoFinanciero\VerifyProductoFinancieroAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Middleware\JsonBodyParserMiddleware;
use App\Application\Middleware\OfficerAccountIdentityMiddleware;
use Psr\Http\Message\ServerRequestInterface;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/bp/products/', function (Group $group) {
        $group->get('', ListProductosFinancierosAction::class);
        $group->post('', CreateProductoFinancieroAction::class)->addMiddleware(new JsonBodyParserMiddleware());
        $group->put('', UpdateProductoFinancieroAction::class)->addMiddleware(new JsonBodyParserMiddleware());
        $group->delete('', DeleteProductoFinancieroAction::class);
        $group->get('verification', VerifyProductoFinancieroAction::class);
    })->addMiddleware(new OfficerAccountIdentityMiddleware($app));

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $customErrorHandler = function (
        ServerRequestInterface $request,
        Throwable $exception
    ) use ($app) {
        $payload = ['error' => $exception->getMessage()];
        $response = $app->getResponseFactory()->createResponse()->withStatus($exception->getCode() ?? 500);
        $response->getBody()->write(
            json_encode($payload, JSON_UNESCAPED_UNICODE)
        );
        return $response;
    };

    $app->addErrorMiddleware(false, false, false)->setDefaultErrorHandler($customErrorHandler);
};
