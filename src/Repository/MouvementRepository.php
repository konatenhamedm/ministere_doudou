<?php

namespace App\Repository;

use App\Entity\Mouvement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mouvement>
 *
 * @method Mouvement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mouvement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mouvement[]    findAll()
 * @method Mouvement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MouvementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mouvement::class);
    }

    public function add(Mouvement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mouvement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function lastReference($annee)
    {
        $annee = substr($annee, -2);
        //KPL-C-{AN}XXX
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        return $this->createQueryBuilder('a')
            ->select("a.reference")

            ->orderBy('CAST(SUBSTRING(a.reference, -3) AS UNSIGNED)', 'DESC')
            ->andWhere('SUBSTRING(a.reference, 7, 2) = :annee')
            ->setParameter('annee', $annee)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function generateReference($annee)
    {
        $data = $this->lastReference($annee);

        if ($data) {
            $chrono = substr($data['reference'], -3);
            $chrono = ltrim($chrono, '0');
        } else {
            $chrono = 0;
        }
        return 'KPL-S-' . substr($annee, -2) . str_pad(($chrono + 1), 3, '0', STR_PAD_LEFT);
    }



    //    /**
    //     * @return Mouvement[] Returns an array of Mouvement objects
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

    //    public function findOneBySomeField($value): ?Mouvement
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
