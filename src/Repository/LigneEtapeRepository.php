<?php

namespace App\Repository;

use App\Entity\LigneEtape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LigneEtape>
 *
 * @method LigneEtape|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneEtape|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneEtape[]    findAll()
 * @method LigneEtape[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneEtapeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneEtape::class);
    }

//    /**
//     * @return LigneEtape[] Returns an array of LigneEtape objects
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

//    public function findOneBySomeField($value): ?LigneEtape
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
