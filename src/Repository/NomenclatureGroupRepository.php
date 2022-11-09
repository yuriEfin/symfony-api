<?php

namespace App\Repository;

use App\Entity\NomenclatureGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomenclatureGroup>
 *
 * @method NomenclatureGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomenclatureGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomenclatureGroup[]    findAll()
 * @method NomenclatureGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomenclatureGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomenclatureGroup::class);
    }

    public function add(NomenclatureGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NomenclatureGroup $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NomenclatureGroup[] Returns an array of NomenclatureGroup objects
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

//    public function findOneBySomeField($value): ?NomenclatureGroup
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
