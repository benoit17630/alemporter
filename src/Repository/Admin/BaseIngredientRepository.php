<?php

namespace App\Repository\Admin;

use App\Entity\Admin\BaseIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BaseIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseIngredient[]    findAll()
 * @method BaseIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BaseIngredient::class);
    }

    // /**
    //  * @return BaseIngredient[] Returns an array of BaseIngredient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BaseIngredient
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
