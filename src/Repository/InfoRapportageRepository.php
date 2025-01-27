<?php

namespace App\Repository;

use App\Entity\InfoRapportage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InfoRapportage>
 *
 * @method InfoRapportage|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfoRapportage|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfoRapportage[]    findAll()
 * @method InfoRapportage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfoRapportageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoRapportage::class);
    }

//    /**
//     * @return InfoRapportage[] Returns an array of InfoRapportage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InfoRapportage
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
