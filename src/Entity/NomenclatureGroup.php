<?php

namespace App\Entity;

use App\Repository\NomenclatureGroupRepository;
use App\Traits\Entity\Column\CreatedAtTrait;
use App\Traits\Entity\Column\IdAiPkTrait;
use App\Traits\Entity\Column\UpdatedAtTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NomenclatureGroupRepository::class)]
class NomenclatureGroup
{
    use IdAiPkTrait, CreatedAtTrait, UpdatedAtTrait;
    
    #[ORM\Column(type: 'string', length: 100)]
    private ?string $title = null;
    
    #[ORM\Column(type: 'string', length: 300, nullable: true)]
    private ?string $description = null;
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        
        return $this;
    }
}
