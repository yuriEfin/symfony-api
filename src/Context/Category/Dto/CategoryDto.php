<?php

namespace App\Context\Category\Dto;

use App\Context\Category\Dto\Interfaces\CategoryInterface;
use App\Context\Interfaces\Dto\DtoInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryDto implements DtoInterface, CategoryInterface
{
    #[Assert\Type('int')]
    private ?int $id = null;
    #[Assert\Type('int')]
    private ?int $parentId = null;
    private ?string $parentTitle = null;
    #[Assert\Type('string')]
    private ?string $title = null;
    #[Assert\Type('string')]
    private ?string $slug = null;
    #[Assert\Type('string')]
    private ?string $statusId = null;
    private ArrayCollection $childs;
    private ?string $parseUrl = null;
    
    public function __construct(string $title, ArrayCollection $childs)
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
     *
     * @return CategoryDto
     */
    public function setId(?int $id): CategoryDto
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @param string|null $title
     *
     * @return CategoryDto
     */
    public function setTitle(string $title): CategoryDto
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getParentTitle(): ?string
    {
        return $this->parentTitle;
    }
    
    /**
     * @param string|null $parentTitle
     *
     * @return CategoryDto
     */
    public function setParentTitle(?string $parentTitle): CategoryDto
    {
        $this->parentTitle = $parentTitle;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    /**
     * @param string|null $slug
     *
     * @return CategoryDto
     */
    public function setSlug(?string $slug): CategoryDto
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getStatusId(): ?string
    {
        return $this->statusId;
    }
    
    /**
     * @param string|null $statusId
     *
     * @return CategoryDto
     */
    public function setStatusId(?string $statusId): CategoryDto
    {
        $this->statusId = $statusId;
        
        return $this;
    }
    
    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }
    
    /**
     * @param int|null $parentId
     *
     * @return CategoryDto
     */
    public function setParentId(?int $parentId): CategoryDto
    {
        $this->parentId = $parentId;
        
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
     *
     * @return CategoryDto
     */
    public function setChilds(ArrayCollection $childs): CategoryDto
    {
        $this->childs = $childs;
        
        return $this;
    }
    
    /**
     * @return string|null
     */
    public function getParseUrl(): ?string
    {
        return $this->parseUrl;
    }
    
    /**
     * @param string|null $parseUrl
     *
     * @return CategoryDto
     */
    public function setParseUrl(?string $parseUrl): CategoryDto
    {
        $this->parseUrl = $parseUrl;
        
        return $this;
    }
}