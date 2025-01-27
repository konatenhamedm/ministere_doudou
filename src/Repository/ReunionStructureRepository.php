<?php

namespace App\Repository;

use App\Entity\ReunionStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReunionStructure>
 *
 * @method ReunionStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReunionStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReunionStructure[]    findAll()
 * @method ReunionStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReunionStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReunionStructure::class);
    }

//    /**
//     * @return ReunionStructure[] Returns an array of ReunionStructure objects
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

//    public function findOneBySomeField($value): ?ReunionStructure
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
