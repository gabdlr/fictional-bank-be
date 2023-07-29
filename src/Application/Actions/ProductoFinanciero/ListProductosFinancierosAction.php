<?php

declare(strict_types=1);

namespace App\Application\Actions\ProductoFinanciero;

use App\Application\DTO\ProductoFinancieroDTO;
use Psr\Http\Message\ResponseInterface as Response;
use App\Domain\ProductoFinanciero\ProductoFinanciero;

class ListProductosFinancierosAction extends ProductoFinancieroAction
{

  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    /** 
     * @var array<ProductoFinanciero> $productosFinancieros
     */
    $productosFinancieros = $this->entityManager->getRepository(ProductoFinanciero::class)->findAll();

    $newResponse = [];
    foreach ($productosFinancieros as $productoFinanciero) {
      $productDTO = new ProductoFinancieroDTO($productoFinanciero);
      array_push($newResponse, (array)$productDTO);
    }


    return $this->respondWithData($newResponse);
  }
}
