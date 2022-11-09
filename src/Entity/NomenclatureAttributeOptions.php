<?php

namespace App\Entity;

use App\Repository\NomenclatureAttributeOptionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NomenclatureAttributeOptionsRepository::class)]
class NomenclatureAttributeOptions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'integer')]
    private $nomenclatureId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function setNomenclatureId(int $nomenclatureId): self
    {
        $this->nomenclatureId = $nomenclatureId;

        return $this;
    }
}
