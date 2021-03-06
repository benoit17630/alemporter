<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Cheese;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cheese|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cheese|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cheese[]    findAll()
 * @method Cheese[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheeseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cheese::class);
    }

    public function searchByCheese($search)
    {
        return $this->createQueryBuilder('c')

            ->orWhere('c.name like :search')
            ->setParameter('search','%'. $search.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Cheese[] Returns an array of Cheese objects
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
    public function findOneBySomeField($value): ?Cheese
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
