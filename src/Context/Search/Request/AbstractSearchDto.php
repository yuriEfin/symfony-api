<?php

namespace App\Context\Search\Request;

use App\Context\Search\Constant\PaginationConstant;

class AbstractSearchDto
{
    protected int $offset = 0;
    protected int $limit = PaginationConstant::DEFAULT_PAGE_ITEMS_COUNT;
    protected array $links = [];
    
    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset ?? 0;
    }
    
    /**
     * @param int $offset
     *
     * @return AbstractSearchDto
     */
    public function setOffset(?int $offset): AbstractSearchDto
    {
        $this->offset = $offset ?? 0;
        
        return $this;
    }
    
    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit ?? PaginationConstant::DEFAULT_PAGE_ITEMS_COUNT;
    }
    
    /**
     * @param int $limit
     *
     * @return AbstractSearchDto
     */
    public function setLimit(?int $limit): AbstractSearchDto
    {
        $this->limit = $limit ?? PaginationConstant::DEFAULT_PAGE_ITEMS_COUNT;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }
    
    /**
     * @param array $links
     *
     * @return AbstractSearchDto
     */
    public function setLinks(array $links): AbstractSearchDto
    {
        $this->links = $links;
        
        return $this;
    }
}