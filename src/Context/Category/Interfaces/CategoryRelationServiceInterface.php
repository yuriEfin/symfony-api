<?php

namespace App\Context\Category\Interfaces;

use App\Context\Category\Dto\Interfaces\CategoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

interface CategoryRelationServiceInterface
{
    public function assign(CategoryInterface $categoryDto, ArrayCollection $children);
}