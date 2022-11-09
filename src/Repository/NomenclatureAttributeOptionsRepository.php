<?php

namespace App\Repository;

use App\Entity\NomenclatureAttributeOptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomenclatureAttributeOptions>
 *
 * @method NomenclatureAttributeOptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomenclatureAttributeOptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomenclatureAttributeOptions[]    findAll()
 * @method NomenclatureAttributeOptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomenclatureAttributeOptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomenclatureAttributeOptions::class);
    }

    public function add(NomenclatureAttributeOptions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NomenclatureAttributeOptions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NomenclatureAttributeOptions[] Returns an array of NomenclatureAttributeOptions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NomenclatureAttributeOptions
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
