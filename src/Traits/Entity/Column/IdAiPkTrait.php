<?php

namespace App\Traits\Entity\Column;

use Doctrine\ORM\Mapping as ORM;

trait IdAiPkTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }
}