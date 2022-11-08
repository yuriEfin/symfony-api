<?php

namespace App\Entity;

use App\Repository\BalanceTransactionRepository;
use App\Traits\Entity\Column\CreatedAtTrait;
use App\Traits\Entity\Column\IdAiPkTrait;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity(repositoryClass: BalanceTransactionRepository::class)]
#[ORM\HasLifecycleCallbacks]
class BalanceTransaction
{
    use IdAiPkTrait, CreatedAtTrait;
    
    #[ORM\ManyToOne(targetEntity: Balance::class, inversedBy: 'balance',  cascade: ['persist'])]
    private Balance $balance;
    
    #[ORM\Column(type: 'float')]
    private ?float $sum;
    
    #[ORM\Column(type: 'string', length: 30)]
    private string $type;
    
    /**
     * @return Balance
     */
    public function getBalance(): Balance
    {
        return $this->balance;
    }
    
    /**
     * @param Balance $balance
     *
     * @return BalanceTransaction
     */
    public function setBalance(Balance $balance): self
    {
        $this->balance = $balance;
        
        return $this;
    }
    
    public function getSum(): ?float
    {
        return $this->sum;
    }
    
    public function setSum(float $sum): self
    {
        $this->sum = $sum;
        
        return $this;
    }
    
    public function getType(): ?string
    {
        return $this->type;
    }
    
    public function setType(string $type): self
    {
        $this->type = $type;
        
        return $this;
    }
}
