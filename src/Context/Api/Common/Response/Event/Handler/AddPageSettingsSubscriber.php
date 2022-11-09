<?php

namespace App\Context\Api\Common\Response\Event\Handler;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AddPageSettingsSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [
                'onKernelResponsePre',
                10,
            ],
        ];
    }
    
    public function onKernelResponsePre(ResponseEvent $responseEvent)
    {
        $response = $responseEvent->getResponse();
        $content = json_decode($response->getContent(), true);
        if ($content['meta'] ?? false) {
            // example getting page setting and add to api response
            // OR
            // possible use pattern "Chain of responsibility" for more complex processing
            $content['meta'] = array_merge($content['meta'], ['pageSettings' => ['key' => 'value1', 'key2' => 'value2']]);
            $responseEvent->getResponse()->setContent(json_encode($content));
        }
    }
}