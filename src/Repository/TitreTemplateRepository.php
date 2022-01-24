<?php

namespace App\Repository;

use App\Entity\TitreTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TitreTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method TitreTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method TitreTemplate[]    findAll()
 * @method TitreTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TitreTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TitreTemplate::class);
    }

    // /**
    //  * @return TitreTemplate[] Returns an array of TitreTemplate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TitreTemplate
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
