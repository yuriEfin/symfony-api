<?php

namespace App\Repository;

use App\Context\Category\Dto\CategoryDto;
use App\Context\Category\Dto\Search\SearchDto;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    
    public function getQueryList(SearchDto $searchDto): Query
    {
        $query = $this->createQueryBuilder('c')
            ->setFirstResult($searchDto->getOffset())
            ->setMaxResults($searchDto->getLimit());
        
        if ($searchDto->id) {
            $query->andWhere($query->expr()->eq('c.id', $searchDto->id));
        }
        
        if ($searchDto->ids) {
            $query->andWhere($query->expr()->in('c.id', $searchDto->ids));
        }
        
        if ($searchDto->title) {
            $query->andWhere($query->expr()->like('c.title', ':title'))
                ->setParameter('title', $searchDto->title);
        }
        
        return $query->getQuery();
        //var_dump($query->getSQL(),'$query'); die;
    }
    
    public function create(Category $entity, bool $flush = false): Category
    {
        $this->getEntityManager()->persist($entity);
        
        if ($flush) {
            $this->getEntityManager()->flush();
        }
        
        return $entity;
    }
    
    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    //    /**
    //     * @return Category[] Returns an array of Category objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }
    
    //    public function findOneBySomeField($value): ?Category
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
