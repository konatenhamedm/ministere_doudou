<?php

namespace App\Repository;

use App\Entity\DateHistorique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateHistorique>
 *
 * @method DateHistorique|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateHistorique|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateHistorique[]    findAll()
 * @method DateHistorique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateHistoriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateHistorique::class);
    }

//    /**
//     * @return DateHistorique[] Returns an array of DateHistorique objects
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

//    public function findOneBySomeField($value): ?DateHistorique
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
