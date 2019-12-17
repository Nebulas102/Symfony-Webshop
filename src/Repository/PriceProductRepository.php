<?php

namespace App\Repository;

use App\Entity\PriceProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PriceProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method PriceProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method PriceProduct[]    findAll()
 * @method PriceProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PriceProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceProduct::class);
    }

    // /**
    //  * @return PriceProduct[] Returns an array of PriceProduct objects
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
    public function findOneBySomeField($value): ?PriceProduct
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
