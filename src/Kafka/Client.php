<?php

namespace App\Kafka;


use App\Kafka\Exceptions\NotImplementedException;
use App\Kafka\Interfaces\KafkaClientInterface;
use Enqueue\RdKafka\RdKafkaMessage;
use Interop\Queue\ConnectionFactory;
use Interop\Queue\Topic;
use RdKafka\TopicConf;
use Interop\Queue\Context;

class Client implements KafkaClientInterface
{
    private Context         $context;
    private ?Topic          $topic;
    private ?RdKafkaMessage $packet = null;
    
    public function __construct(private readonly ConnectionFactory $kafkaConnectionFactory)
    {
        $this->context = $this->kafkaConnectionFactory
            ->createContext();
    }
    
    public function createTopic(string $topicName, string $key = null): self
    {
        $this->topic = $this->context
            ->createTopic($topicName);
        
        if ($key) {
            $this->topic->setKey($key);
        }
        
        return $this;
    }
    
    public function createPacket(array $message, array $options = []): self
    {
        $this->packet = new RdKafkaMessage(json_encode($message), $options);
        $this->packet->setKey($this->topic->getKey());
        
        return $this;
    }
    
    public function push(): void
    {
        $this->getProducer()->send(
            $this->topic,
            $this->packet
        );
        
        $this->reset();
    }
    
    
    public function getProducer(): \Interop\Queue\Producer
    {
        return $this->context->createProducer();
    }
    
    public function createConsumer(Topic $topic): \Interop\Queue\Consumer
    {
        return $this->context->createConsumer($topic);
    }
    
    private function reset()
    {
        $this->packet = null;
        $this->topic = null;
    }
    
    /**
     * @throws NotImplementedException
     */
    public function pushWithTransaction(int $identifier, bool $isCommit = false): void
    {
        /** @todo */
        throw new NotImplementedException();
        /*
        $producer = $this->getProducer();
        $producer->initTransaction($identifier);
        $producer->beginTransaction();
        
        $this->push();
        
        if ($isCommit) {
            $producer->commitTransaction($identifier);
        }
        */
    }
}
