<?php

namespace App\Repository;

use App\Entity\SourceFinancement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SourceFinancement>
 *
 * @method SourceFinancement|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceFinancement|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceFinancement[]    findAll()
 * @method SourceFinancement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceFinancementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceFinancement::class);
    }

//    /**
//     * @return SourceFinancement[] Returns an array of SourceFinancement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SourceFinancement
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
