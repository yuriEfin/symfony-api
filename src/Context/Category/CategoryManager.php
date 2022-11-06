<?php

namespace App\Context\Category;

use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Dto\CreateCategoryResultDto;
use App\Context\Category\Dto\Interfaces\CategoryInterface;
use App\Context\Category\Dto\Search\SearchDto;
use App\Context\Category\Interfaces\CategoryManagerInterface;
use App\Context\Category\Interfaces\CategoryRelationServiceInterface;
use App\Context\Category\Interfaces\CategoryServiceInterface;
use App\Entity\Categories;
use App\Entity\Category;
use App\Repository\CategoriesRepository;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\Common\Collections\Collection;

class CategoryManager implements CategoryManagerInterface
{
    private CategoryServiceInterface $categoryService;
    private CategoriesRepository $categoryRepository;
    
    public function __construct(
        CategoryServiceInterface $categoryService,
        CategoriesRepository $categoryRepository
    ) {
        $this->categoryService = $categoryService;
        $this->categoryRepository = $categoryRepository;
    }
    
    public function findOneByTitle(string $title): ?Categories
    {
        return $this->categoryService->findByTitle($title);
    }
    
    public function findById(int $id): ?Categories
    {
        return $this->categoryRepository->find($id);
    }
    
    public function getQueryList(SearchDto $searchDto): Query
    {
        return $this->categoryRepository->getQueryList($searchDto);
    }
    
    public function create(CategoryDto $categoryDto): CreateCategoryResultDto
    {
        return $this->categoryService->create($categoryDto);
    }
    
    public function update(CategoryDto $categoryDto): CreateCategoryResultDto
    {
        return $this->categoryService->update($categoryDto);
    }
    
    public function createBatch(ArrayCollection $categories): array
    {
        $result = [];
        /** @var CategoryDto $category */
        foreach ($categories as $category) {
            $result[] = $this->create($category);
        }
        
        return $result;
    }
}