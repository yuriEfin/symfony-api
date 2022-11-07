<?php

namespace App\Controller\Api\Common\Response;

use App\Context\Search\Constant\PaginationConstant;
use App\Controller\Api\Common\Response\Interfaces\ResponseModelInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

class JsonApiResponse implements ResponseModelInterface
{
    private array $meta = [];
    private mixed $data = [];
    
    #[Ignore()]
    private int $limit = 0;
    #[Ignore()]
    private int $offset = 0;
    #[Ignore()]
    private string $collectionEnvelop = 'items';
    
    public function __construct(int $limit = PaginationConstant::DEFAULT_PAGE_ITEMS_COUNT, ?int $offset = 0)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }
    
    public function setLimit(?int $limit): JsonApiResponse
    {
        $this->limit = $limit ?? PaginationConstant::DEFAULT_PAGE_ITEMS_COUNT;
        
        return $this;
    }
    
    public function setOffset(?int $offset): JsonApiResponse
    {
        $this->offset = $offset ?? 0;
        
        return $this;
    }
    
    public function getMeta(): array
    {
        return $this->meta;
    }
    
    public function setMeta(array $meta): JsonApiResponse
    {
        $this->meta = $meta;
        
        return $this;
    }
    
    public function getData(): mixed
    {
        return $this->data;
    }
    
    public function setData(mixed $data): JsonApiResponse
    {
        $this->data = array_merge(
            ['limit' => $this->limit, 'offset' => $this->offset, 'totalCount' => count($data)],
            [$this->getCollectionEnvelop() => $data]
        );
        
        return $this;
    }
    
    public function setCollectionEnvelop(string $collectionEnvelop): self
    {
        $this->collectionEnvelop = $collectionEnvelop;
        
        return $this;
    }
    
    public function getCollectionEnvelop(): string
    {
        return $this->collectionEnvelop;
    }
}