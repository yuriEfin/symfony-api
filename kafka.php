<?php



use Enqueue\RdKafka\RdKafkaConnectionFactory;

// connect to Kafka broker at example.com:1000 plus custom options
$connectionFactory = new RdKafkaConnectionFactory(
    [
        'global' => [
            'group.id'             => uniqid('', true),
            'metadata.broker.list' => 'example.com:1000',
            'enable.auto.commit'   => 'false',
        ],
        'topic'  => [
            'auto.offset.reset' => 'beginning',
        ],
    ]
);

// if you have enqueue/enqueue library installed you can use a factory to build context from DSN
$context = (new \Enqueue\ConnectionFactoryFactory())->create('kafka:')->createContext();
$testEventsTopic = $context->createTopic('test_events');
$messages = ['messaga 1', 'messaga 2', 'messaga 3'];
foreach ($messages as $message) {
    echo "\nMessage:\n$message\n\n";
    $context->createProducer()->send($testEventsTopic, $message);
}