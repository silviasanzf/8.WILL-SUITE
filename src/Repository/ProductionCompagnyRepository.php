<?php

namespace App\Repository;

use App\Entity\ProductionCompagny;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductionCompagny|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionCompagny|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionCompagny[]    findAll()
 * @method ProductionCompagny[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionCompagnyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductionCompagny::class);
    }

    // /**
    //  * @return ProductionCompagny[] Returns an array of ProductionCompagny objects
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
    public function findOneBySomeField($value): ?ProductionCompagny
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
