<?php

namespace App\Repository;

use App\Entity\DrivingLicence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DrivingLicence|null find($id, $lockMode = null, $lockVersion = null)
 * @method DrivingLicence|null findOneBy(array $criteria, array $orderBy = null)
 * @method DrivingLicence[]    findAll()
 * @method DrivingLicence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrivingLicenceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DrivingLicence::class);
    }

    // /**
    //  * @return DrivingLicence[] Returns an array of DrivingLicence objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DrivingLicence
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
