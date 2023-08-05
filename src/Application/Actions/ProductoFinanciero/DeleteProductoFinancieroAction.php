<?php

declare(strict_types=1);

namespace App\Application\Actions\ProductoFinanciero;

use App\Domain\ProductoFinanciero\ProductoFinanciero;
use Psr\Http\Message\ResponseInterface;

class DeleteProductoFinancieroAction extends ProductoFinancieroAction
{
  public function action(): ResponseInterface
  {

    $params = $this->request->getQueryParams();
    if (array_key_exists("id", $params) && !is_null($params['id'])) {
      $id = $params['id'];
      /**
       * @var ProductoFinanciero|null $entity
       */
      $entity = $this->entityManager->getRepository(ProductoFinanciero::class)->findOneBy(array("id" => $id));
      if ($entity) {
        try {
          $this->entityManager->remove($entity);
          $this->entityManager->flush();
          return $this->respondWithData(array("messagge" => "Product successfully removed"), 200);
        } catch (\Exception $e) {
          //handle exception
        }
      } else {
        throw new \Exception("Not product found with that id", 404);
      }
    }
  }
}
