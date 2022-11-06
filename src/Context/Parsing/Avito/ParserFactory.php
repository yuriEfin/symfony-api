<?php

namespace App\Context\Parsing\Avito;

use App\Context\Parsing\Interfaces\ParserInterface;
use InvalidArgumentException;
use App\Context\Parsing\Avito\Product\Parser as ProductParser;
use App\Context\Parsing\Avito\Menu\Parser as MenuParser;

class ParserFactory
{
    public static function create($category): ParserInterface
    {
        switch ($category) {
            case CategoryConstant::MENU:
                $parser = new MenuParser();
                break;
            case CategoryConstant::PRODUCT:
                $parser = new ProductParser();
                break;
            default:
                throw new InvalidArgumentException('Не найден обработчик для категории');
        }
        
        return $parser;
    }
}