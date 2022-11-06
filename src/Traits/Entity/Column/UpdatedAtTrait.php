<?php

namespace App\Traits\Entity\Column;

use DateTimeImmutable;
use DateTimeInterface;

trait UpdatedAtTrait
{
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }
    
    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }
    
    public function initUpdatedAt(): void
    {
        $this->setUpdatedAt(new DateTimeImmutable());
    }
}