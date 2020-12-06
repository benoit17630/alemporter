<?php


namespace App\Repository\Admin;

use App\Entity\Admin\LastIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LastIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method LastIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method LastIngredient[]    findAll()
 * @method LastIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LastIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LastIngredient::class);
    }


}