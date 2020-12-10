<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Meat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meat[]    findAll()
 * @method Meat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meat::class);
    }

    public function searchByMeat($search)
    {
        return $this->createQueryBuilder('m')

            ->orWhere('m.name like :search')
            ->setParameter('search','%'. $search.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Meat[] Returns an array of Meat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meat
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
