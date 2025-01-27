<?php

namespace App\Repository;

use App\Entity\TypePlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypePlan>
 *
 * @method TypePlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePlan[]    findAll()
 * @method TypePlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePlan::class);
    }

//    /**
//     * @return TypePlan[] Returns an array of TypePlan objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypePlan
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
