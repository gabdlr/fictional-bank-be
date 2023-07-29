<?php

declare(strict_types=1);

namespace App\Application\Actions\ProductoFinanciero;

use App\Application\Actions\Action;
use Doctrine\ORM\EntityManager;

abstract class ProductoFinancieroAction extends Action
{

  protected EntityManager $entityManager;
  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
  }
}
