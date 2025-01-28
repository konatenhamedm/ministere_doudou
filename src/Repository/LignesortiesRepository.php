<?php

namespace App\Repository;

use App\Entity\Lignesorties;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lignesorties>
 *
 * @method Lignesorties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lignesorties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lignesorties[]    findAll()
 * @method Lignesorties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignesortiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lignesorties::class);
    }

//    /**
//     * @return Lignesorties[] Returns an array of Lignesorties objects
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

//    public function findOneBySomeField($value): ?Lignesorties
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
