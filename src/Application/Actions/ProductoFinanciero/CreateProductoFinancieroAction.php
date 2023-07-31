<?php

declare(strict_types=1);

namespace App\Application\Actions\ProductoFinanciero;

use App\Application\DTO\ProductoFinanciero\ProductoFinancieroRequestDTO;
use App\Domain\ProductoFinanciero\ProductoFinanciero;
use Psr\Http\Message\ResponseInterface;

class CreateProductoFinancieroAction extends ProductoFinancieroAction
{
  protected function action(): ResponseInterface
  {
    $nuevoProductoFinanciero = null;
    $productoFinancieroRequest = $this->request->getParsedBody();
    if (array_key_exists('id', $productoFinancieroRequest)) {
      $productoFinancieroDTO = new ProductoFinancieroRequestDTO($productoFinancieroRequest);
      $productoFinanciero = (new ProductoFinanciero())->fromDTO($productoFinancieroDTO);
      try {
        $this->entityManager->persist($productoFinanciero);
        $this->entityManager->flush();
        $nuevoProductoFinanciero = $this->entityManager->getRepository(ProductoFinanciero::class)->findOneBy(array('id' => $productoFinancieroRequest['id']));
      } catch (\Throwable $th) {
        //error code 1062 si ya existe el id 
      }
    }
    if (!is_null($nuevoProductoFinanciero)) {
      return $this->respondWithData((array)$nuevoProductoFinanciero->toDTO(), 201);
    } else {
      return $this->response->withStatus(400, "Bad Request");
    }
  }
}
