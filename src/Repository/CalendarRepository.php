<?php

namespace App\Repository;

use App\Entity\Calendar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Calendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendar[]    findAll()
 * @method Calendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendar::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Calendar $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Calendar $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function getEvenement()
    {
        return $this->createQueryBuilder("e")
            ->select("e.title", "e.id")
            ->orderBy('e.start', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getEventDatePasse()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
                $sql = "
                    SELECT * 
                    FROM calendar c
                  where c.end > NOW() and c.active = 1
                    ";
        $stmt = $conn->executeQuery($sql);
        return $stmt->fetchAllAssociative();
    }

    public function getEventDateEncours()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "
                    SELECT * 
                    FROM calendar c
                  where c.start >= NOW() and c.active = 1
                    ";
        $stmt = $conn->executeQuery($sql);
        return $stmt->fetchAllAssociative();
    }
    public function getEventDateValide()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = "
                    SELECT * 
                    FROM calendar c
                  where c.start <= NOW() and c.end <= NOW() and c.active = 1
                    ";
        $stmt = $conn->executeQuery($sql);
        return $stmt->fetchAllAssociative();
    }
    // /**
    //  * @return Calendar[] Returns an array of Calendar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Calendar
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
