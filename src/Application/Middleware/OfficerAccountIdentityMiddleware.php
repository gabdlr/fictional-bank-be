<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class OfficerAccountIdentityMiddleware implements MiddlewareInterface
{

  public function process(Request $request, RequestHandler $handler): Response
  {
    $contentType = $request->getHeader('Authorization');
    if (count($contentType) === 0) {
      throw new \Exception("Header Authorization is missing", 400);
    }
    return $handler->handle($request);
  }
}
