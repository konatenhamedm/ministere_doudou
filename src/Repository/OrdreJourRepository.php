<?php

namespace App\Repository;

use App\Entity\OrdreJour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrdreJour>
 *
 * @method OrdreJour|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrdreJour|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrdreJour[]    findAll()
 * @method OrdreJour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdreJourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrdreJour::class);
    }

//    /**
//     * @return OrdreJour[] Returns an array of OrdreJour objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OrdreJour
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
