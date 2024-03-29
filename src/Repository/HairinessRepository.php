<?php

namespace App\Repository;

use App\Entity\Hairiness;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Hairiness|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hairiness|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hairiness[]    findAll()
 * @method Hairiness[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HairinessRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hairiness::class);
    }

    // /**
    //  * @return Hairiness[] Returns an array of Hairiness objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hairiness
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
