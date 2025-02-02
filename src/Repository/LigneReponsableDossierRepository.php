<?php

namespace App\Repository;

use App\Entity\LigneReponsableDossier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LigneReponsableDossier>
 *
 * @method LigneReponsableDossier|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneReponsableDossier|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneReponsableDossier[]    findAll()
 * @method LigneReponsableDossier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneReponsableDossierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneReponsableDossier::class);
    }

//    /**
//     * @return LigneReponsableDossier[] Returns an array of LigneReponsableDossier objects
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

//    public function findOneBySomeField($value): ?LigneReponsableDossier
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
