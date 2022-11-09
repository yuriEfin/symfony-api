<?php

namespace App\Command;


use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Interfaces\CategoryManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:category-fill',
    description: 'Заполнение данными категорий',
)]
class CategoryFillCommand extends Command
{
    private CategoryManagerInterface $categoryManager;
    
    public function __construct(CategoryManagerInterface $categoryManager)
    {
        $this->categoryManager = $categoryManager;
        
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
        $io = new SymfonyStyle($input, $output);
        
        $categories = $this->getList();
        $bufferCategories = [];
        foreach ($categories as $category) {
            $childCategories = $this->getChild($category);
            
            $categoryDto = new CategoryDto($category['name'], new ArrayCollection($childCategories));
            $categoryDto
                ->setId($category['id'])
                ->setStatusId($category['status'])
                ->setParseUrl($this->getUrl($category));
            
            $bufferCategories[] = $categoryDto;
        }
        $this->categoryManager->createBatch(new ArrayCollection($bufferCategories));
        
        $io->success('Finished!');
        
        return Command::SUCCESS;
    }
    
    private function getUrl(array $data): ?string
    {
        $parseUrl = $data['url'];
        if (empty($parseUrl)) {
            $parseUrl = sprintf('%s/%s/%d/%s', 'https://cdek.shopping/', 'c', $data['id'], $data['slug']);
        }
        
        return $parseUrl;
    }
    
    private function getChild($category): array
    {
        $children = [];
        foreach ($category['published_children'] ?? [] as $categoryChildItem) {
            $categoryDto = new CategoryDto($categoryChildItem['name'], new ArrayCollection($this->getChild($categoryChildItem)));
            
            $categoryDto
                ->setParentTitle($category['name'])
                ->setId($categoryChildItem['id'])
                ->setParseUrl($this->getUrl($categoryChildItem))
                ->setStatusId($categoryChildItem['status']);
            
            $children[$category['id']][] = $categoryDto;
        }
        
        return $children;
    }
    
    private function getList(): array
    {
        $categories = file_get_contents('/var/www/symfony/var/parsers/menu/menu.json');
        if (false === $categories) {
            return [];
        }
        
        return json_decode($categories, true);
    }
}
