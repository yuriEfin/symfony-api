<?php

namespace App\Repository;

use App\Entity\NomanclatureAtributeValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomanclatureAtributeValue>
 *
 * @method NomanclatureAtributeValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomanclatureAtributeValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomanclatureAtributeValue[]    findAll()
 * @method NomanclatureAtributeValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomanclatureAtributeValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomanclatureAtributeValue::class);
    }

    public function add(NomanclatureAtributeValue $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NomanclatureAtributeValue $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NomanclatureAtributeValue[] Returns an array of NomanclatureAtributeValue objects
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

//    public function findOneBySomeField($value): ?NomanclatureAtributeValue
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
