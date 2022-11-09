<?php

namespace App\Entity;

use App\Repository\NomenclatureRepository;
use App\Traits\Entity\Column\CreatedAtTrait;
use App\Traits\Entity\Column\IdAiPkTrait;
use App\Traits\Entity\Column\UpdatedAtTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NomenclatureRepository::class)]
class Nomenclature
{
    use IdAiPkTrait, CreatedAtTrait, UpdatedAtTrait;
    
    #[ORM\Column(type: 'string', length: 300)]
    private ?string $title = null;
    
    #[ORM\Column(type: 'float')]
    private float $price = 0.0;
    
    #[ORM\Column(type: 'float', nullable: true)]
    private float $externalPrice = 0.0;
    
    #[ORM\Column(type: 'integer')]
    private ?int $defaultTax = null;
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getPrice(): ?float
    {
        return $this->price;
    }
    
    public function setPrice(float $price): self
    {
        $this->price = $price;
        
        return $this;
    }
    
    public function getExternalPrice(): float
    {
        return $this->externalPrice;
    }
    
    public function setExternalPrice(float $externalPrice): Nomenclature
    {
        $this->externalPrice = $externalPrice;
        
        return $this;
    }
    
    public function getDefaultTax(): ?int
    {
        return $this->defaultTax;
    }
    
    public function setDefaultTax(int $defaultTax): self
    {
        $this->defaultTax = $defaultTax;
        
        return $this;
    }
}
