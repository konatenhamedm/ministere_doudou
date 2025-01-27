<?php

namespace App\Repository;

use App\Entity\Rapportage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rapportage>
 *
 * @method Rapportage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rapportage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rapportage[]    findAll()
 * @method Rapportage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rapportage::class);
    }

//    /**
//     * @return Rapportage[] Returns an array of Rapportage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rapportage
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
