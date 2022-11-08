<?php

namespace App\Traits\Entity\Column;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait CreatedAtTrait
{
    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $createdAt;
    
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }
    
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $this->createdAt ?? $createdAt;
        
        return $this;
    }
    
    #[ORM\PrePersist]
    public function initCreatedAt(): void
    {
        $this->setCreatedAt(new DateTime());
    }
}