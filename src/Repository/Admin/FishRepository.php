<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Fish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fish[]    findAll()
 * @method Fish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fish::class);
    }

    public function searchByFish($search)
    {
        return $this->createQueryBuilder('f')

            ->orWhere('f.name like :search')
            ->setParameter('search','%'. $search.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Fish[] Returns an array of Fish objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fish
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
