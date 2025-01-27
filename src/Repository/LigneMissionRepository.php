<?php

namespace App\Repository;

use App\Entity\LigneMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LigneMission>
 *
 * @method LigneMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneMission[]    findAll()
 * @method LigneMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneMission::class);
    }

//    /**
//     * @return LigneMission[] Returns an array of LigneMission objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LigneMission
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
