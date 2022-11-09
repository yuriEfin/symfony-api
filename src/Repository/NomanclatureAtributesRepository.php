<?php

namespace App\Repository;

use App\Entity\NomanclatureAtributes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomanclatureAtributes>
 *
 * @method NomanclatureAtributes|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomanclatureAtributes|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomanclatureAtributes[]    findAll()
 * @method NomanclatureAtributes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomanclatureAtributesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomanclatureAtributes::class);
    }

    public function add(NomanclatureAtributes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(NomanclatureAtributes $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return NomanclatureAtributes[] Returns an array of NomanclatureAtributes objects
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

//    public function findOneBySomeField($value): ?NomanclatureAtributes
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
