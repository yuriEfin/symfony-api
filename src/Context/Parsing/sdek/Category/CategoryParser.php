<?php

namespace App\Context\Parsing\sdek\Category;


use App\Context\Parsing\AbstractParsingService;
use App\Context\Parsing\Interfaces\ParserInterface;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;

class CategoryParser extends AbstractParsingService
{
    public function __construct(private readonly CategoriesRepository $categoriesRepository)
    {
    }
    
    public function parse(): void
    {
        $categories = $this->categoriesRepository->findAll();
        $items = [];
        foreach ($categories as $category) {
            $parseUrl = $category->getParseUrl();
            
            $response = $this->getBrowser()->request('GET', $parseUrl)->outerHtml();
            
            $filePath = sprintf('/var/www/symfony/var/parsers/nomenclature/%s.html', str_replace(['/'], '-', $parseUrl));
            file_put_contents($filePath, $response);
            
            $items[$category->getId()] = $filePath;
        }
        
        file_put_contents('/var/www/symfony/var/parsers/nomenclature/config.json', json_encode($items));
        
        $this->parseAsyncKafka($items);
    }
    
    private function parseAsyncKafka(array $items)
    {
        foreach ($items as $item) {
            echo "new Packet() to Kafka\n";
            //            $packet = new KafkaPacket();
        }
    }
    
    private function parseAsyncRabbitMQ(array $items)
    {
        foreach ($items as $item) {
            echo "new Packet() to RabbitMq\n";
            //            $packet = new RabbitMqPacket();
        }
    }
}
