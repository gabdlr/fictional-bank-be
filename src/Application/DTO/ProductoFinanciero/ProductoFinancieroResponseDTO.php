<?php

declare(strict_types=1);

namespace App\Application\DTO\ProductoFinanciero;

use App\Domain\ProductoFinanciero\ProductoFinanciero;
use App\Application\DTO\ProductoFinanciero\ProductoFinancieroDTO;

class ProductoFinancieroResponseDTO extends ProductoFinancieroDTO
{

  public function __construct(ProductoFinanciero $productoFinanciero)
  {
    $this->id = $productoFinanciero->getId();
    $this->name = $productoFinanciero->getName();
    $this->description = $productoFinanciero->getDescription();
    $this->logo = $productoFinanciero->getLogo();
    $this->date_release = $productoFinanciero->getDate_release();
    $this->date_revision = $productoFinanciero->getDate_revision();
  }
}
