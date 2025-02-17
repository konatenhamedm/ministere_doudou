<?php

namespace App\Repository;

use App\Entity\EtatStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtatStock>
 *
 * @method EtatStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatStock[]    findAll()
 * @method EtatStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatStock::class);
    }

//    /**
//     * @return EtatStock[] Returns an array of EtatStock objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EtatStock
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
