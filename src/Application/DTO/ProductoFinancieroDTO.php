<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\ProductoFinanciero\ProductoFinanciero;

class ProductoFinancieroDTO
{

  public int $id;
  public string $name;
  public string $description;
  public string $logo;
  public string $date_release;
  public string $date_revision;

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
