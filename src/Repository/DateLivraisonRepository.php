<?php

namespace App\Repository;

use App\Entity\DateLivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateLivraison>
 *
 * @method DateLivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateLivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateLivraison[]    findAll()
 * @method DateLivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateLivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateLivraison::class);
    }

//    /**
//     * @return DateLivraison[] Returns an array of DateLivraison objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DateLivraison
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
