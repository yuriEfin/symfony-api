<?php

namespace App\Context\Parsing\Avito\Menu;

use App\Context\Parsing\AbstractParsingService;
use App\Context\Parsing\Avito\CategoryConstant;
use App\Context\Parsing\Interfaces\ParserInterface;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class Parser extends AbstractParsingService implements ParserInterface
{
    private const CATEGORY_MENU = CategoryConstant::MENU;
    
    protected string $baseUrl = 'https://cdek.shopping';
    protected string $selector = '#category';
    protected array $parsedData = [];
    
    public function parse(): void
    {
        $this->parsedData = [];
        $browser = $this->getBrowser();
        $crawler = $browser->request(
            'GET',
            $this->baseUrl,
            [],
            [],
            $this->getServerParams()
        );
        $parentLinks = [];
        foreach ($crawler->filter('.cd-header-menu__link a') as $link) {
            if ('' === $link->textContent || !$link->attributes['href']->nodeValue) {
                continue;
            }
            $parseUrlData = parse_url($this->baseUrl);
            $this->parsedData['parents'][] = [
                'title'      => trim($link->textContent),
                'link'       => trim($link->attributes['href']->nodeValue),
                'externalId' => (int)$link->parentNode->getAttribute('data-id'),
            ];
        }
        
        if (!empty($this->parsedData)) {
            $this->getChilds();
        }
    }
    
    private function getChilds()
    {
        foreach ($this->parsedData as $key => &$parentItem) {
            foreach ($parentItem as $index => $item) {
                echo "\n" . $item['link'] . "\n";
                $crawler = $this->getBrowser()->request('GET', $item['link'], [], [], $this->getServerParams());
                
                $data = $crawler->filter('menu-categories');
                $categories = json_decode($data->attr('categories'), true);
                file_put_contents('/var/www/symfony/var/parsers/menu/menu.json', trim($data->attr('categories')));
                
                var_export($categories);
                break;
            }
        }
    }
}