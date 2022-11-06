<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use App\Traits\Entity\Column\CreatedAtTrait;
use App\Traits\Entity\Column\UpdatedAtTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    use CreatedAtTrait, UpdatedAtTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    
    #[ORM\Column(type: 'string', length: 155, unique: false)]
    private ?string $title = null;
    
    #[ORM\ManyToMany(targetEntity: Categories::class, mappedBy: 'childs')]
    private ?Collection $parent = null;
    
    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'parent', cascade: ['persist'])]
    private Collection $childs;
    
    #[ORM\Column(type: 'string', length: 200, unique: true)]
    #[Gedmo\Slug(fields: ['title'])]
    private ?string $slug = null;
    
    #[ORM\ManyToOne(targetEntity: CategoriesStatus::class)]
    private ?CategoriesStatus $status = null;
    
    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeInterface $createdAt;
    
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?DateTimeInterface $updatedAt;
    
    public function __construct()
    {
        $this->parent = new ArrayCollection();
        $this->childs = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(?int $id): self
    {
        $this->id = $id;
        
        return $this;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * @return Collection
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }
    
    /**
     * @param Collection $parent
     *
     * @return Categories
     */
    public function setParent(Collection $parent): self
    {
        $this->parent = $parent;
        
        return $this;
    }
    
    public function getChilds(): ArrayCollection|PersistentCollection
    {
        return $this->childs;
    }
    
    public function setChilds(Collection $childs): self
    {
        $this->childs = $childs;
        
        return $this;
    }
    
    public function getSlug(): ?string
    {
        return $this->slug;
    }
    
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    public function getStatus(): ?CategoriesStatus
    {
        return $this->status;
    }
    
    public function setStatus(?CategoriesStatus $status): self
    {
        $this->status = $status;
        
        return $this;
    }
}
