<?php

namespace App\Context\Category\Dto;

use App\Context\Category\Dto\Interfaces\CategoryInterface;
use App\Context\Interfaces\Dto\DtoInterface;
use Doctrine\Common\Collections\ArrayCollection;

class CategoryDto implements DtoInterface, CategoryInterface
{
    private ?int $id = null;
    private ?string $title = null;
    private ArrayCollection $childs;

    public function __construct($title, ArrayCollection $childs)
    {
        $this->title = $title;
        $this->childs = $childs;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return CategoryDto
     */
    public function setId(int $id): CategoryDto
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): CategoryDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getChilds(): ArrayCollection
    {
        return $this->childs;
    }

    /**
     * @param ArrayCollection $childs
     * @return CategoryDto
     */
    public function setChilds(ArrayCollection $childs): CategoryDto
    {
        $this->childs = $childs;
        return $this;
    }
}