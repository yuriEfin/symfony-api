<?php

namespace App\Context\Interfaces\Crud;

use App\Context\Interfaces\Dto\DtoInterface;

interface UpdateInterface
{
    public function update(DtoInterface $dto);
}