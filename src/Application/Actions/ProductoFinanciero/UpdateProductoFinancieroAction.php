<?php

declare(strict_types=1);

namespace App\Application\Actions\ProductoFinanciero;

use App\Application\DTO\ProductoFinanciero\ProductoFinancieroRequestDTO;
use App\Domain\ProductoFinanciero\ProductoFinanciero;
use Psr\Http\Message\ResponseInterface;

class UpdateProductoFinancieroAction extends ProductoFinancieroAction
{
  public function action(): ResponseInterface
  {
    $productoFinancieroRequest = $this->request->getParsedBody();
    if (array_key_exists('id', $productoFinancieroRequest) && !is_null($productoFinancieroRequest["id"])) {
      $id = $productoFinancieroRequest["id"];
      try {
        /**
         * @var ProductoFinanciero|null $productoFinanciero
         */
        $productoFinanciero = $this->entityManager->getRepository(ProductoFinanciero::class)->findOneBy(array("id" => $id));
        if (!is_null($productoFinanciero)) {
          $productoFinancieroDTO = new ProductoFinancieroRequestDTO($productoFinancieroRequest);
          $this->entityManager->persist($productoFinanciero->fromDTO($productoFinancieroDTO));
          $this->entityManager->flush();
          return $this->respondWithData((array)$productoFinanciero->toDTO(), 200);
        } else {
          throw new \Exception("Not product found with that id", 404);
        }
      } catch (\Throwable $th) {
        throw new \Exception("An unhandled exception has occurred", 500);
      }
    }
    throw new \Exception("Not product found with that id", 404);
  }
}
