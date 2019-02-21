<?php

namespace App\Repository;

use App\Entity\ColorHair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ColorHair|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColorHair|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColorHair[]    findAll()
 * @method ColorHair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColorHairRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ColorHair::class);
    }

    // /**
    //  * @return ColorHair[] Returns an array of ColorHair objects
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
    public function findOneBySomeField($value): ?ColorHair
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
