<?php

namespace App\Context\Category;


use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Dto\CreateCategoryResultDto;
use App\Context\Category\Dto\Interfaces\CategoryInterface;
use App\Context\Category\Interfaces\CategoryServiceInterface;
use App\Context\Interfaces\Dto\DtoInterface;
use App\Entity\Categories;
use App\Entity\Category;
use App\Repository\CategoriesRepository;
use App\Repository\CategoriesStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class CategoryService implements CategoryServiceInterface
{
    private CategoriesRepository       $categoriesRepository;
    private CategoriesStatusRepository $categoriesStatusRepository;
    
    public function __construct(CategoriesRepository $categoriesRepository, CategoriesStatusRepository $categoriesStatusRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->categoriesStatusRepository = $categoriesStatusRepository;
    }
    
    /**
     * @param CategoryDto|DtoInterface $dto
     *
     * @return void
     */
    public function create(CategoryInterface|DtoInterface $dto): CreateCategoryResultDto
    {
        $status = $this->categoriesStatusRepository->findOneBy(['alias' => $dto->getStatusId()]);
        if ($status === null) {
            $status = $this->categoriesStatusRepository->find(1);
        }
        $parentCategory = $this->findByTitle($dto->getTitle());
        
        $entity = $parentCategory ?? new Categories();
        $entity
            ->setTitle($dto->getTitle())
            ->setStatus($status)
            ->setParseUrl($dto->getParseUrl())
            ->setParent(new ArrayCollection())
            ->setChilds(new ArrayCollection($this->getChild($dto, $parentCategory)))
            ->setUpdatedAt(new \DateTimeImmutable());
        
        $createdCategory = $this->categoriesRepository->create($entity, true);
        
        return new  CreateCategoryResultDto($createdCategory->getId(), $createdCategory->getTitle());
    }
    
    
    private function getChild(CategoryDto $category, ?Categories $parent): array
    {
        $status = $this->categoriesStatusRepository->findOneBy(['alias' => $category->getStatusId()]);
        if ($status === null) {
            $status = $this->categoriesStatusRepository->find(1);
        }
        
        $children = [];
        foreach ($category->getChilds() ?? [] as $categoryChildItems) {
            /** @var CategoryDto $childItem */
            foreach ($categoryChildItems ?? [] as $childItem) {
                $entityChildItem = $this->findByTitle($childItem->getTitle());
                
                $category = $entityChildItem ?? new Categories();
                $category
                    ->setTitle($childItem->getTitle())
                    ->setParseUrl($childItem->getParseUrl())
                    ->setChilds(new ArrayCollection($this->getChild($childItem, $entityChildItem)))
                    ->setStatus($status);
                
                if ($parent) {
                    $category->setParent(new ArrayCollection([$parent]));
                }
                
                $children[] = $category;
            }
        }
        
        return $children;
    }
    
    public function findByTitle(string $title): ?Categories
    {
        return $this->categoriesRepository->findOneBy(['title' => trim($title)]);
    }
    
    public function delete(DtoInterface $dto)
    {
        // TODO: Implement delete() method.
    }
    
    public function update(DtoInterface $dto)
    {
    }
}