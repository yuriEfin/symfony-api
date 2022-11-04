<?php

namespace App\Context\Category\Dto;

class CreateCategoryResultDto
{
    public ?int $id;
    protected bool $isSuccess = false;
    
    public function __construct(?int $id)
    {
        $this->id = $id;
    }
    
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
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