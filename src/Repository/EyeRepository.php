<?php

namespace App\Repository;

use App\Entity\Eye;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Eye|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eye|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eye[]    findAll()
 * @method Eye[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EyeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Eye::class);
    }

    // /**
    //  * @return Eye[] Returns an array of Eye objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Eye
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
