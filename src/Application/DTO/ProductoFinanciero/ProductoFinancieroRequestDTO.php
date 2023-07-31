<?php

declare(strict_types=1);

namespace App\Application\DTO\ProductoFinanciero;

use App\Application\DTO\ProductoFinanciero\ProductoFinancieroDTO;
use DateTime;
use Exception;

class ProductoFinancieroRequestDTO extends ProductoFinancieroDTO
{
  public function __construct(array $productoFinanciero)
  {
    if (!array_key_exists('id', $productoFinanciero) || is_null($productoFinanciero['id'])) {
      throw new Exception("No se puede construir un nuevo Producto Financiero sin id");
    }
    $this->id = $productoFinanciero['id'];
    $this->name = $productoFinanciero['name'] ?? '';
    $this->description = $productoFinanciero['description'] ?? '';
    $this->logo = $productoFinanciero['logo'] ?? '';
    $this->date_release = $productoFinanciero['date_relase'] ?? (new DateTime())->format("Y-m-d");
    $this->date_revision = $productoFinanciero['date_revision'] ?? (new DateTime())->add(\DateInterval::createFromDateString('1 year'))->format("Y-m-d");
  }
}
