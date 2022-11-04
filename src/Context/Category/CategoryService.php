<?php

namespace App\Context\Category;

use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Dto\Interfaces\CategoryInterface;
use App\Context\Category\Interfaces\CategoryServiceInterface;
use App\Context\Interfaces\Dto\DtoInterface;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class CategoryService implements CategoryServiceInterface
{
    private EntityManagerInterface $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @param CategoryDto|DtoInterface $dto
     *
     * @return void
     */
    public function create(CategoryInterface|DtoInterface $dto)
    {
        $entity = new Category();
        $entity->setTitle($dto->getTitle())
            ->setUpdated(new \DateTime());
        
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
    
    public function delete(CategoryInterface|DtoInterface $dto)
    {
        $entity = $this->entityManager->find(Category::class, $dto->getId());
        
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
    
    public function update(CategoryInterface|DtoInterface $dto)
    {
        $entity = $this->entityManager->find(Category::class, $dto->getId());
        $entity->setTitle($dto->getTitle())
            ->setUpdated(new DateTime());
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}