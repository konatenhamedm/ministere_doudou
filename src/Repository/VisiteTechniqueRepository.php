<?php

namespace App\Repository;

use App\Entity\VisiteTechnique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisiteTechnique>
 *
 * @method VisiteTechnique|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisiteTechnique|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisiteTechnique[]    findAll()
 * @method VisiteTechnique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteTechniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisiteTechnique::class);
    }

//    /**
//     * @return VisiteTechnique[] Returns an array of VisiteTechnique objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VisiteTechnique
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
