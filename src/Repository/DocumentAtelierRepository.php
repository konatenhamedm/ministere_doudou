<?php

namespace App\Repository;

use App\Entity\DocumentAtelier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DocumentAtelier>
 *
 * @method DocumentAtelier|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentAtelier|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentAtelier[]    findAll()
 * @method DocumentAtelier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentAtelierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocumentAtelier::class);
    }

//    /**
//     * @return DocumentAtelier[] Returns an array of DocumentAtelier objects
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

//    public function findOneBySomeField($value): ?DocumentAtelier
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
