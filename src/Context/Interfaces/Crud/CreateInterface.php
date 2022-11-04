<?php

namespace App\Context\Interfaces\Crud;

use App\Context\Interfaces\Dto\DtoInterface;

interface CreateInterface
{
    public function create(DtoInterface $dto);
}