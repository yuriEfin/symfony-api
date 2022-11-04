<?php

namespace App\Context\Category\Dto\Interfaces;

use App\Context\Interfaces\Dto\DtoInterface;

interface CategoryInterface extends DtoInterface
{
    public function getId(): ?int;
    
    public function getTitle(): string;
}
