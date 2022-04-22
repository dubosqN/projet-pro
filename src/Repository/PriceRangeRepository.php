<?php

namespace App\Repository;

use App\Entity\PriceRange;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PriceRange|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceRange|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceRange[]    findAll()
 * @method PriceRange[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceRangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceRange::class);
    }

    // /**
    //  * @return PriceRange[] Returns an array of PriceRange objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PriceRange
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
