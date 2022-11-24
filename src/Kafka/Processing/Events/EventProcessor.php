<?php

namespace App\Kafka\Processing\Events;


use Interop\Queue\Message;
use Interop\Queue\Context;
use Interop\Queue\Processor;
use Enqueue\Client\TopicSubscriberInterface;

class EventProcessor implements Processor, TopicSubscriberInterface
{
    public function process(Message $message, Context $context)
    {
        echo $message->getBody();
        
        return self::ACK;
        // return self::REJECT; // when the message is broken
        // return self::REQUEUE; // the message is fine but you want to postpone processing
    }
    
    public static function getSubscribedTopics()
    {
        return ['symfony_events'];
    }
}
