<?php

declare(strict_types=1);

namespace App\Application\DTO\ProductoFinanciero;

abstract class ProductoFinancieroDTO
{
  public int $id;
  public string $name;
  public string $description;
  public string $logo;
  public string $date_release;
  public string $date_revision;
}
