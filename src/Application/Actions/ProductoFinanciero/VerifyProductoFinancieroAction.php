<?php

declare(strict_types=1);

namespace App\Application\Actions\ProductoFinanciero;

use App\Domain\ProductoFinanciero\ProductoFinanciero;
use Psr\Http\Message\ResponseInterface;

use function PHPUnit\Framework\isNull;

class VerifyProductoFinancieroAction extends ProductoFinancieroAction
{

  protected function action(): ResponseInterface
  {
    $productoFinanciero = false;
    $params = $this->request->getQueryParams();

    if (array_key_exists("id", $params) && !is_null($params['id'])) {
      $id = $params['id'];
      try {
        $productoFinanciero = (bool) $this->entityManager->getRepository(ProductoFinanciero::class)->findBy(['id' => $id]);
      } catch (\Throwable $th) {
        //handle error
      }
    }
    return $this->respondWithData($productoFinanciero);
  }
}
