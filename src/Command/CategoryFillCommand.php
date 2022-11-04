<?php

namespace App\Command;

use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Interfaces\CategoryManagerInterface;
use App\Entity\Category;
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
        
        foreach ($this->getList() as $parentTitle => $childs) {
            $childCategories = array_map(fn(string $title) => (new Category())->setTitle($title), $childs);
            $categoryDto = new CategoryDto($parentTitle, new ArrayCollection($childCategories));
            $this->categoryManager->create($categoryDto);
        }
        $io->success('Finished!');
        
        return Command::SUCCESS;
    }
    
    private function getList(): array
    {
        return [
            'Транспорт'                     => [
                'Автомобили',
                'Мотоциклы и мототехника',
                'Грузовики и спецтехника',
                'Водный транспорт',
                'Запчасти и аксессуары',
            ],
            'Для дома и дачи'               => [
                'Ремонт и строительство',
                'Мебель и интерьер',
                'Бытовая техника',
                'Продукты питания',
                'Растения',
                'Посуда и товары для кухни',
            ],
            'Готовый бизнес и оборудование' => [
                'Готовый бизнес',
                'Оборудование для бизнеса',
            ],
            'Недвижимость'                  => [
                'Квартиры',
                'Комнаты',
                'Дома, дачи, коттеджи',
                'Земельные участки',
                'Гаражи и машиноместа',
                'Коммерческая недвижимость',
                'Недвижимость за рубежом',
                'Ипотечный калькулятор',
            ],
            'Электроника'                   => [
                'Телефоны',
                'Аудио и видео',
                'Товары для компьютера',
                'Игры, приставки и программы',
                'Ноутбуки',
                'Настольные компьютеры',
                'Фототехника',
                'Планшеты и электронные книги',
                'Оргтехника и расходники',
            ],
            'Работа'                        => [
                'Вакансии',
                'Резюме',
            ],
            'Услуги'                        => [],
            'Хобби и отдых'                 => [
                'Билеты и путешествия',
                'Велосипеды',
                'Книги и журналы',
                'Коллекционирование',
                'Музыкальные инструменты',
                'Охота и рыбалка',
                'Спорт и отдых',
            ],
            'Личные вещи'                   => [
                'Одежда, обувь, аксессуары',
                'Детская одежда и обувь',
                'Товары для детей и игрушки',
                'Красота и здоровье',
                'Часы и украшения',
            ],
            'Животные'                      => [
                'Собаки',
                'Кошки',
                'Птицы',
                'Аквариум',
                'Другие животные',
                'Товары для животных',
            ],
        ];
    }
}
