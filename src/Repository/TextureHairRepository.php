<?php

namespace App\Repository;

use App\Entity\TextureHair;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TextureHair|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextureHair|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextureHair[]    findAll()
 * @method TextureHair[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextureHairRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TextureHair::class);
    }

    // /**
    //  * @return TextureHair[] Returns an array of TextureHair objects
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
    public function findOneBySomeField($value): ?TextureHair
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
