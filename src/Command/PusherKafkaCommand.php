<?php

namespace App\Command;


use App\Entity\Categories;
use App\Kafka\Interfaces\KafkaClientInterface;
use Enqueue\RdKafka\RdKafkaMessage;
use Enqueue\RdKafka\RdKafkaTopic;
use Interop\Queue\ConnectionFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
use RdKafka\TopicConf;

#[AsCommand(
    name: 'app:pusher-kafka',
    description: 'Add a short description for your command',
)]
class PusherKafkaCommand extends Command
{
    private const NAME = 'app:pusher-kafka';
    
    public function __construct(private readonly KafkaClientInterface $kafkaClient)
    {
        parent::__construct(self::NAME);
    }
    
    protected function configure(): void
    {
        $this->addArgument('message', InputArgument::REQUIRED, 'Message to topic')
            ->addArgument('key', InputArgument::REQUIRED, 'Key for message and topic')
            ->addArgument('id', InputArgument::REQUIRED, 'Key for message and topic')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $mess = $input->getArgument('message');
        $key = $input->getArgument('key');
        $id = $input->getArgument('id');
        $io->success(sprintf('Process message "%s" send to topic "%s" with key %s ...', $mess, 'sf_crud_events', 'crud'));
        
        $this->kafkaClient
            ->createTopic('sf_crud_events', $key)
            ->createPacket(json_encode(['type' => 'create', 'body' => ['entity' => Categories::class, 'message' => $mess]]))
            ->push();
        
        $io->success(sprintf('Message "%s" sended to topic "%s" with key %s', $mess, 'sf_crud_events', 'crud'));
        
        return Command::SUCCESS;
    }
    
    public function old()
    {
        // connect to Kafka broker at example.com:1000 plus custom options
        $connectionFactory = new RdKafkaConnectionFactory(
            [
                'global' => [
                    'group.id'             => uniqid('', true),
                    'metadata.broker.list' => 'kafka:9092',
                    'enable.auto.commit'   => 'false',
                ],
                'topic'  => [
                    'auto.offset.reset' => 'beginning',
                ],
            ]
        );
        
        // if you have enqueue/enqueue library installed you can use a factory to build context from DSN
        $context = $connectionFactory->createContext();
        $topics = [
            'foo-bar',
            'akbars',
            'bbq',
            'samsung',
        ];
        $messages = ['messaga ' . uniqid('body_'), 'messaga ' . uniqid('body_'), 'messaga ' . uniqid('body_')];
        
        $groups = [
            'foo',
            'bar',
            'foo-bar',
        ];
        $i = 100;
        $topicList = [];
        while ($i > 0) {
            $message = $messages[array_rand($messages, 1)];
            $groupId = $groups[array_rand($groups)];
            $packet = new RdKafkaMessage($message, ['group.id' => $groupId]);
            $packet->setKey($groupId);
            $testEventsTopic = $context->createTopic($groupId);
            $testEventsTopic->setKey($groupId);
            $io->info(sprintf('Pushed to topic: %s, ', $groupId));
            $testEventsTopic->setPartition($i);
            $context->createProducer()->send(
                $testEventsTopic,
                $packet
            );
            $topicList[] = $testEventsTopic;
            $i--;
        }
        
        /** @var RdKafkaTopic $item */
        foreach ($topicList as $item) {
            while (true) {
                $consumer = $context->createConsumer($item);
                $consumer->getQueue()->setPartition($item->getPartition());
                if ($message = $consumer->receive()) {
                    $consumer->acknowledge($message);
                    $io->info("Asked: " . $message->getBody() . "\n\n");
                }
            }
        }
    }
}
