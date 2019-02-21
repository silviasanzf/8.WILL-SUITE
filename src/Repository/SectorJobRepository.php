<?php

namespace App\Repository;

use App\Entity\SectorJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SectorJob|null find($id, $lockMode = null, $lockVersion = null)
 * @method SectorJob|null findOneBy(array $criteria, array $orderBy = null)
 * @method SectorJob[]    findAll()
 * @method SectorJob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SectorJobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SectorJob::class);
    }

    // /**
    //  * @return SectorJob[] Returns an array of SectorJob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SectorJob
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
