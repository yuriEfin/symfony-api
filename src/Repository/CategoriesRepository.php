<?php

namespace App\Repository;

use App\Context\Category\Dto\Search\SearchDto;
use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categories>
 *
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categories::class);
    }
    
    public function getQueryList(SearchDto $searchDto): Query
    {
        $query = $this->createQueryBuilder('c')
            ->setMaxResults($searchDto->getLimit())
            ->setFirstResult($searchDto->getOffset());
        
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
    }
    
    public function create(Categories $entity, bool|null $flush = null): Categories
    {
        $flush ??= false;
        $this->getEntityManager()->persist($entity);
        
        if ($flush) {
            $this->getEntityManager()->flush();
        }
        
        return $entity;
    }
    
    public function remove(Categories $entity, bool|null $flush = null): void
    {
        $flush ??= false;
        $this->getEntityManager()->remove($entity);
        
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    //    /**
    //     * @return Categories[] Returns an array of Categories objects
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
    
    //    public function findOneBySomeField($value): ?Categories
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
