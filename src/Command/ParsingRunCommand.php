<?php

namespace App\Command;


use App\Context\Parsing\Avito\CategoryConstant;
use App\Context\Parsing\Avito\Menu\Parser as MenuParser;
use App\Context\Parsing\Avito\ParserFactory;
use App\Context\Parsing\sdek\Category\CategoryParser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:parsing-run',
    description: 'Add a short description for your command',
)]
class ParsingRunCommand extends Command
{
    private const NAME = 'app:parsing-run';
    
    public function __construct(private CategoryParser $categoryParser)
    {
        parent::__construct(self::NAME);
    }
    
    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        
        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }
        
        //        $parser = ParserFactory::create(CategoryConstant::MENU);
        //        $parser->parse();
        
        $this->categoryParser->parse();
        
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
        
        return Command::SUCCESS;
    }
}
