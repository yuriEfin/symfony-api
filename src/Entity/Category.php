<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use DateTime;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements \JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    
    #[ORM\Column(type: 'string', length: 200)]
    private ?string $title = null;
    
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'id', cascade: ["persist"])]
    private Collection $childs;
    
    #[ORM\Column(type: 'datetimetz', nullable: true)]
    private ?DateTimeInterface $created = null;
    
    #[ORM\Column(type: 'datetimetz', nullable: true)]
    private ?DateTimeInterface $updated = null;
    
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
    
    public function getChilds(): Collection
    {
        return $this->childs;
    }
    
    /**
     * @param static[]|Collection $childs
     */
    public function setChilds(Collection $childs): Category
    {
        $this->childs = $childs;
        
        return $this;
    }
    
    public function addChild(Category $child): Category
    {
        if (!$this->childs->contains($child)) {
            $this->childs->add($child);
        }
        
        return $this;
    }
    
    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }
    
    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;
        
        return $this;
    }
    
    /**
     * @return DateTimeInterface|null
     */
    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }
    
    /**
     * @param DateTimeInterface|null $created
     *
     * @return Category
     */
    public function setCreated(?DateTimeInterface $created): Category
    {
        $this->created = $created;
        
        return $this;
    }
    
    /**
     * @throws \Exception
     * @ORM\PrePersist()
     */
    public function beforeSave()
    {
        $this->created = new DateTime('now', new \DateTimeZone('Africa/Casablanca'));
    }
    
    public function jsonSerialize(): mixed
    {
        return [
            'id'    => $this->getId(),
            'title' => $this->getTitle(),
            'child' => $this->getChilds()->getIterator(),
        ];
    }
}
