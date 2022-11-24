<?php

namespace App\Context\Parsing;


use App\Context\Parsing\Interfaces\ParserInterface;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

abstract class AbstractParsingService implements ParserInterface
{
    protected string $baseUrl;
    
    private ?HttpBrowser $browser = null;
    
    protected function getBrowser(): HttpBrowser
    {
        if (null === $this->browser) {
            $this->browser = new HttpBrowser(HttpClient::create());
        }
        
        return $this->browser;
    }
    
    protected function getServerParams(): array
    {
        return [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
            'headers'         => [
                'content-Type' => 'text/html; charset=utf-8',
                'accept'       => '*/*',
                'user-agent'   => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
            ],
        ];
    }
}
