<?php

namespace App\Traits\Entity\Column;

use DateTimeImmutable;
use DateTimeInterface;

trait CreatedAtTrait
{
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    
    public function initCreatedAt(): void
    {
        $this->setCreatedAt(new DateTimeImmutable());
    }
}