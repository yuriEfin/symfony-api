<?php

namespace App\Context\Category\Dto;

class CreateCategoryResultDto
{
    public ?int $id;
    public ?string $title;
    protected bool $isSuccess = false;
    
    public function __construct(?int $id, ?string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }
    
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->id !== null;
    }
    
    /**
     * @param bool $isSuccess
     *
     * @return CreateCategoryResultDto
     */
    public function setIsSuccess(bool $isSuccess): CreateCategoryResultDto
    {
        $this->isSuccess = $isSuccess;
        
        return $this;
    }
}