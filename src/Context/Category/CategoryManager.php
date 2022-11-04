<?php

namespace App\Context\Category;

use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Dto\CreateCategoryResultDto;
use App\Context\Category\Dto\Interfaces\CategoryInterface;
use App\Context\Category\Dto\Search\SearchDto;
use App\Context\Category\Interfaces\CategoryManagerInterface;
use App\Context\Category\Interfaces\CategoryRelationServiceInterface;
use App\Context\Category\Interfaces\CategoryServiceInterface;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Query;
use Doctrine\Common\Collections\Collection;

class CategoryManager implements CategoryManagerInterface
{
    private CategoryServiceInterface $categoryService;
    private CategoryRepository $categoryRepository;
    
    public function __construct(
        CategoryServiceInterface $categoryService,
        CategoryRepository $categoryRepository
    ) {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }
    
    public function getQueryList(SearchDto $searchDto): Query
    {
        return $this->categoryRepository->getQueryList($searchDto);
    }
    
    public function create(CategoryDto $categoryDto): CreateCategoryResultDto
    {
        $entity = new Category();
        $entity->setTitle($categoryDto->getTitle())
            ->setChilds($categoryDto->getChilds());
        
        $createdEntity = $this->categoryRepository->create($entity, true);
        
        return new CreateCategoryResultDto($createdEntity->getId());
    }
}