<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\LigneRetourDemande;
use App\Entity\Materiel;
use App\Entity\RetourDemande;
use App\Entity\Scolarite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LigneRetourDemande>
 *
 * @method LigneRetourDemande|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneRetourDemande|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneRetourDemande[]    findAll()
 * @method LigneRetourDemande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneRetourDemandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneRetourDemande::class);
    }
    public function add(LigneRetourDemande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllLines($id)
    {
        return $this->createQueryBuilder('l')
            ->select('a.designation', 'l.quantiteSortie', 'l.quantiteRetournee')
            ->innerJoin(RetourDemande::class, 'r', 'WITH', 'r.id=l.retourDemande')
            ->innerJoin(Article::class, 'a', 'WITH', 'a.id=l.article')
            ->andWhere('r.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    public function save(LigneRetourDemande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LigneRetourDemande $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return LigneRetourDemande[] Returns an array of LigneRetourDemande objects
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

    //    public function findOneBySomeField($value): ?LigneRetourDemande
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
