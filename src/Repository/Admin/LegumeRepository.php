<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Legume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Legume|null find($id, $lockMode = null, $lockVersion = null)
 * @method Legume|null findOneBy(array $criteria, array $orderBy = null)
 * @method Legume[]    findAll()
 * @method Legume[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegumeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Legume::class);
    }

    public function searchByLegume($search)
    {
        return $this->createQueryBuilder('l')

            ->orWhere('l.name like :search')
            ->setParameter('search','%'. $search.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Legume[] Returns an array of Legume objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Legume
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
