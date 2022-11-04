<?php

namespace App\Context\Interfaces\Crud;

use App\Context\Interfaces\Dto\DtoInterface;

interface DeleteInterface
{
    public function delete(DtoInterface $dto);
}