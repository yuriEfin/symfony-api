<?php

namespace App\Context\Category\Dto\Search;

use App\Context\Search\Request\AbstractSearchDto;
use Symfony\Component\Validator\Constraints as Assert;

class SearchDto extends AbstractSearchDto
{
    #[Assert\Type('int')]
    #[Assert\Length(min: 1)]
    public ?int $id;
    
    #[Assert\Type('array')]
    public ?array $ids = null;
    
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 200)]
    public ?string $title;
    
    public ?string $child = null;
    
    public function __construct(?int $id, ?array $ids, ?string $title, ?string $child)
    {
        $this->id = $id;
        $this->ids = $ids;
        $this->title = $title;
        $this->child = $child;
    }
}