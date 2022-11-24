<?php

namespace App\Context\Parsing\Avito\Product;


use App\Context\Parsing\AbstractParsingService;
use App\Context\Parsing\Interfaces\ParserInterface;

class Parser extends AbstractParsingService implements ParserInterface
{
    public function parse(): void
    {
        $categroies =
        $client = $this->getBrowser()->request('GET');
    }
}
