<?php

namespace App\Context\Category\Interfaces;

use App\Context\Category\Dto\CategoryDto;
use App\Context\Interfaces\GetData\GetItemInterface;
use App\Context\Interfaces\GetData\GetListInterface;

interface CategoryManagerInterface extends GetListInterface, GetItemInterface
{
    public function create(CategoryDto $categoryDto);
}