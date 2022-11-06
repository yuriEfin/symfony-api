<?php

namespace App\Controller\Api\Common\Response\Interfaces;

use App\Controller\Api\Common\Response\JsonApiResponse;

interface ResponseModelInterface
{
    public function setLimit(?int $limit);
    
    public function setOffset(?int $offset);
    
    public function getMeta(): array;
    
    public function setMeta(array $meta);
    
    public function getData(): mixed;
    
    public function setData(mixed $data);
}