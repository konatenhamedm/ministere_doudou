<?php

namespace App\Repository;

use App\Entity\TypeFinancement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeFinancement>
 *
 * @method TypeFinancement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeFinancement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeFinancement[]    findAll()
 * @method TypeFinancement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeFinancementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeFinancement::class);
    }

//    /**
//     * @return TypeFinancement[] Returns an array of TypeFinancement objects
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

//    public function findOneBySomeField($value): ?TypeFinancement
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
