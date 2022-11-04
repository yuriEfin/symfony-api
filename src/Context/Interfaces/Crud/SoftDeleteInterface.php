<?php

namespace App\Context\Interfaces\Crud;

use App\Context\Interfaces\Dto\DtoInterface;

interface SoftDeleteInterface
{
    public function softDelete(DtoInterface $dto);
}