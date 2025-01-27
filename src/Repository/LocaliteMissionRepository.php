<?php

namespace App\Repository;

use App\Entity\LocaliteMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LocaliteMission>
 *
 * @method LocaliteMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocaliteMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocaliteMission[]    findAll()
 * @method LocaliteMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocaliteMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocaliteMission::class);
    }

//    /**
//     * @return LocaliteMission[] Returns an array of LocaliteMission objects
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

//    public function findOneBySomeField($value): ?LocaliteMission
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
