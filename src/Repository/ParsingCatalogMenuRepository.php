<?php

namespace App\Repository;

use App\Entity\ParsingCatalogMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ParsingCatalogMenu>
 *
 * @method ParsingCatalogMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParsingCatalogMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParsingCatalogMenu[]    findAll()
 * @method ParsingCatalogMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParsingCatalogMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParsingCatalogMenu::class);
    }

    public function add(ParsingCatalogMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ParsingCatalogMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ParsingCatalogMenu[] Returns an array of ParsingCatalogMenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ParsingCatalogMenu
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
