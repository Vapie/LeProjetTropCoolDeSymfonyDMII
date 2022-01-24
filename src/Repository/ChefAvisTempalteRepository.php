<?php

namespace App\Repository;

use App\Entity\ChefAvisTempalte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChefAvisTempalte|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChefAvisTempalte|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChefAvisTempalte[]    findAll()
 * @method ChefAvisTempalte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChefAvisTempalteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChefAvisTempalte::class);
    }

    // /**
    //  * @return ChefAvisTempalte[] Returns an array of ChefAvisTempalte objects
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
    public function findOneBySomeField($value): ?ChefAvisTempalte
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
