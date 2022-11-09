<?php

namespace App\Traits\Entity\Column;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedAtTrait
{
    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTimeInterface $updatedAt;
    
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