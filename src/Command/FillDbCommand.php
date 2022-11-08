<?php

namespace App\Command;

use App\Entity\Balance;
use App\Entity\BalanceTransaction;
use App\Repository\BalanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Faker\Factory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:fill-db',
    description: 'Fill test data to table balance,balance transaction',
)]
class FillDbCommand extends Command
{
    public BalanceRepository $balanceRepository;
    
    public function __construct(BalanceRepository $balanceRepository)
    {
        $this->balanceRepository = $balanceRepository;
        parent::__construct();
    }
    
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ini_set('memory_limit', '4G');
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create();
        
        $i = 10000000;
        $x = $iteration = 10000;
        while ($i > 0) {
            $balance = new Balance();
            $balance->setTotal($faker->numberBetween(1000, 20000))
                ->setUserId($faker->randomNumber());
            
            $transactions = [];
            $types = ['in', 'out'];
            for ($i = 0; $i <= rand(2, 5); $i++) {
                $transactions[] = (new BalanceTransaction())
                    ->setBalance($balance)
                    ->setSum($faker->numberBetween(200, 500))
                    ->setType($types[array_rand($types, 1)])
                    ->setCreatedAt($faker->dateTimeBetween('-3 years', 'now'))
                ;
            }
            $balance->setTransactions(new ArrayCollection($transactions));
            if ($x === 0) {
                $x = $iteration;
                $this->balanceRepository->add($balance, true);
                $io->info(sprintf('Flushed! %d', $i));
            } else {
                $this->balanceRepository->add($balance);
                $io->info(sprintf('Persist! %d', $x));
            }
            
            $i--;
            $x--;
        }
        
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        
        return Command::SUCCESS;
    }
}
