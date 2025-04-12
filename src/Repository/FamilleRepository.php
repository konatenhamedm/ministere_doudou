<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Demande;
use App\Entity\DemandeAchat;
use App\Entity\Famille;
use App\Entity\LigneDemande;
use App\Entity\LigneDemandeAchat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Famille>
 *
 * @method Famille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Famille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Famille[]    findAll()
 * @method Famille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Famille::class);
    }

    public function add(Famille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getAllFamille($id)
    {
        return $this->createQueryBuilder('f')
            ->select('f.libelle')
            ->innerJoin(Article::class,'a','WITH','a.famille=f.id')
            ->innerJoin(LigneDemande::class,'l','WITH','a.id=l.article')
            ->innerJoin(Demande::class,'d','WITH','d.id=l.demande')
            ->andWhere('d.id = :val')
            ->groupBy('f.libelle')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult()
            ;
    }

    // public function getAllFamilleDemandeAchat($id)
    // {
    //     return $this->createQueryBuilder('f')
    //         ->select('f.libelle')
    //         ->innerJoin(Article::class,'a','WITH','a.famille=f.id')
    //         ->innerJoin(LigneDemandeAchat::class,'l','WITH','a.id=l.article')
    //         ->innerJoin(DemandeAchat::class,'d','WITH','d.id=l.demandeAchat')
    //         ->andWhere('d.id = :val')
    //         ->groupBy('f.libelle')
    //         ->setParameter('val', $id)
    //         ->getQuery()
    //         ->getResult()
    //         ;
    // }

    public function remove(Famille $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function getLastCode()
    {
     $em = $this->getEntityManager();
         return $this->createQueryBuilder('a')
         ->select("a.code")
         
         ->orderBy('CAST(SUBSTRING(a.code, 2) AS UNSIGNED)', 'DESC')
     
         ->setMaxResults(1)
         ->getQuery()
         ->getOneOrNullResult();
             
    }
 
    public function getNextCode(): string
    {
        
        $data = $this->getLastCode();
    
         
        if ($data) {
            $numero = substr($data['code'], 1);
        } else {
            $numero = 0;
        }

        return 'F'.($numero + 1);
    }

//    /**
//     * @return Famille[] Returns an array of Famille objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Famille
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
