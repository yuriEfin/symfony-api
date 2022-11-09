<?php

namespace App\Context\Api\Common\Response\Interfaces;

interface ResponseModelInterface
{
    public function setLimit(?int $limit);
    
    public function setOffset(?int $offset);
    
    public function getMeta(): array;
    
    public function setMeta(array $meta);
    
    public function getData(): mixed;
    
    public function setData(mixed $data);
}