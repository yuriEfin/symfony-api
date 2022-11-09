<?php

namespace App\Entity;

use App\Repository\NomanclatureAtributeValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NomanclatureAtributeValueRepository::class)]
class NomanclatureAtributeValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $attributeId;

    #[ORM\Column(type: 'text', nullable: true)]
    private $attributeValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    public function setAttributeId(int $attributeId): self
    {
        $this->attributeId = $attributeId;

        return $this;
    }

    public function getAttributeValue(): ?string
    {
        return $this->attributeValue;
    }

    public function setAttributeValue(?string $attributeValue): self
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }
}
