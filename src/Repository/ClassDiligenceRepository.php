<?php

namespace App\Repository;

use App\Entity\ClassDiligence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassDiligence>
 *
 * @method ClassDiligence|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassDiligence|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassDiligence[]    findAll()
 * @method ClassDiligence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassDiligenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassDiligence::class);
    }

//    /**
//     * @return ClassDiligence[] Returns an array of ClassDiligence objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ClassDiligence
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
