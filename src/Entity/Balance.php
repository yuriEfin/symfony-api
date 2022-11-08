<?php

namespace App\Entity;

use App\Repository\BalanceRepository;
use App\Traits\Entity\Column\CreatedAtTrait;
use App\Traits\Entity\Column\IdAiPkTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BalanceRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Balance
{
    use IdAiPkTrait, CreatedAtTrait;
    
    #[ORM\Column(type: 'integer')]
    private ?int $userId = null;
    
    #[ORM\Column(type: 'float')]
    private ?float $total = null;
    
    #[ORM\OneToMany(targetEntity: BalanceTransaction::class, cascade: ['persist'], mappedBy: 'balance')]
    private Collection $transactions;
    
    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }
    
    /**
     * @param int|null $userId
     *
     * @return Balance
     */
    public function setUserId(?int $userId): Balance
    {
        $this->userId = $userId;
        
        return $this;
    }
    
    public function getTotal(): ?float
    {
        return $this->total;
    }
    
    public function setTotal(float $total): self
    {
        $this->total = $total;
        
        return $this;
    }
    
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }
    
    public function setTransactions(Collection $transactions): self
    {
        $this->transactions = $transactions;
        
        return $this;
    }
}
