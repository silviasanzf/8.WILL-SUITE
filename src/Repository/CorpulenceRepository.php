<?php

namespace App\Repository;

use App\Entity\Corpulence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Corpulence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Corpulence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Corpulence[]    findAll()
 * @method Corpulence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorpulenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Corpulence::class);
    }

    // /**
    //  * @return Corpulence[] Returns an array of Corpulence objects
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
    public function findOneBySomeField($value): ?Corpulence
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
