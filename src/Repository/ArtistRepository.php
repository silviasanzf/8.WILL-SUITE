<?php

namespace App\Repository;

use App\Entity\Artist;
use App\Entity\ArtistSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Artist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artist[]    findAll()
 * @method Artist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artist::class);
    }


    public function findByCriteria(ArtistSearch $search)
    {
        $query = $this->createQueryBuilder('a');
        $query->join('a.drivingLicences', 'dl');
        $query->join('a.transports', 't');


        if ($search->getAgeMin()) {
            $years1=($search->getAgeMin());
            $interval = \DateInterval::createFromDateString($years1 . 'years');
            $searchedDate1 = (new \DateTime(date('Y-m-d'))) -> sub($interval);
            $query->andWhere('a.birthDate <= :searchedDate1')
                ->setParameter('searchedDate1', $searchedDate1);
        }

        if ($search->getAgeMax()) {
            $years2=($search->getAgeMax());
            $interval = \DateInterval::createFromDateString($years2 . 'years');
            $searchedDate2 = (new \DateTime(date('Y-m-d'))) -> sub($interval);
            $query->andWhere('a.birthDate >= :searchedDate2')
                ->setParameter('searchedDate2', $searchedDate2);
        }

        if ($search->getAleatory()) {
            $query->andWhere('a.city LIKE :aleatory');
            $query->orWhere('a.nationality LIKE  :aleatory');
            $query->orWhere('a.school LIKE :aleatory');
            $query->orWhere('a.degree LIKE :aleatory');
            $query->orWhere('a.conservatory LIKE :aleatory');
            $query->orWhere('a.experiences LIKE :aleatory');
            $query->orWhere('a.practiceSports LIKE :aleatory');
            $query->orWhere('a.handicap LIKE :aleatory');
            $query->orWhere('a.distinctiveSign LIKE :aleatory');
            $query->orWhere('dl.type LIKE :aleatory');
            $query->orWhere('t.type LIKE :aleatory')
                ->setParameter('aleatory', '%' . ($search->getAleatory()) . '%');
        }
        if ($search->getLocation()) {
            $query->andWhere('a.zipCode LIKE :location')
                ->setParameter('location', '%' . ($search->getLocation()) . '%');
        }

        if ($search->getName()) {
            $query->andWhere('a.firstname LIKE :name');
            $query->orWhere('a.marriedName LIKE :name');
            $query->orWhere('a.birthName LIKE :name');
            $query->orWhere('a.pseudonym LIKE :name')
                ->setParameter('name', '%' . ($search->getName()) . '%');
        }
        if ($search->getIsactif()) {
            $query->andWhere('a.isactif = :isactif')
                ->setParameter('isactif', ($search->getisactif() === 'Actif'));
        }

        if ($search->getProfessional()) {
            $query->andWhere('a.professional = :professional')
                ->setParameter('professional', ($search->getProfessional() === 'Professionnel'));
        }

        if ($search->getGender()) {
            $query->andWhere('a.gender = :gender')
                ->setParameter('gender', $search->getGender());
        }
        if ($search->getIntermittent()) {
            $query->andWhere('a.intermittent = :intermittent')
                ->setParameter('intermittent', $search->getIntermittent());
        }


        if ($search->getMinSize()) {
            $query->andWhere('a.height > :minSize')
                ->setParameter('minSize', $search->getMinSize());
        }
        if ($search->getMaxSize()) {
            $query->andWhere('a.height < :maxSize')
                ->setParameter('maxSize', $search->getMaxSize());
        }
        if ($search->getMinWeight()) {
            $query->andWhere('a.height > :minWeight')
                ->setParameter('minWeight', $search->getMinWeight());
        }
        if ($search->getMaxWeight()) {
            $query->andWhere('a.height < :maxWeight')
                ->setParameter('maxWeight', $search->getMaxWeight());
        }
        if ($search->getProgress()) {
            $query->andWhere('a.progress >= :progress')
                ->setParameter('progress', $search->getProgress());
        }

        if ($search->getCorpulence()) {
            $filter = '';
            foreach ($search->getCorpulence() as $key => $corpulence) {
                $filter .= 'a.corpulence = :corpulence' . $key . ' OR ';
                $query->setParameter('corpulence' . $key, $corpulence);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getPhysical()) {
            $filter = '';
            foreach ($search->getPhysical() as $key => $physical) {
                $filter .= 'a.physical = :physical' . $key . ' OR ';
                $query->setParameter('physical' . $key, $physical);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getHairiness()) {
            $filter = '';
            foreach ($search->getHairiness() as $key => $hairiness) {
                $filter .= 'a.hairiness = :hairiness' . $key . ' OR ';
                $query->setParameter('hairiness' . $key, $hairiness);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getHair()) {
            $filter = '';
            foreach ($search->getHair() as $key => $hair) {
                $filter .= 'a.hair = :hair' . $key . ' OR ';
                $query->setParameter('hair' . $key, $hair);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getTextureHair()) {
            $filter = '';
            foreach ($search->getTextureHair() as $key => $textureHair) {
                $filter .= 'a.textureHair = :textureHair' . $key . ' OR ';
                $query->setParameter('textureHair' . $key, $textureHair);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getColorHair()) {
            $filter = '';
            foreach ($search->getColorHair() as $key => $colorHair) {
                $filter .= 'a.colorHair = :colorHair' . $key . ' OR ';
                $query->setParameter('colorHair' . $key, $colorHair);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getEye()) {
            $filter = '';
            foreach ($search->getEye() as $key => $eye) {
                $filter .= 'a.eye = :eye' . $key . ' OR ';
                $query->setParameter('eye' . $key, $eye);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        if ($search->getTransformation()) {
            $filter = '';
            foreach ($search->getTransformation() as $key => $transformation) {
                $filter .= 'a.transformation = :transformation' . $key . ' OR ';
                $query->setParameter('transformation' . $key, $transformation);
            }
            $query->andWhere(trim($filter, 'OR '));
        }
        if ($search->getSectorJob()) {
            $filter = '';
            foreach ($search->getSectorJob() as $key => $sectorJob) {
                $filter .= 'a.sectorJob = :sectorJob' . $key . ' OR ';
                $query->setParameter('sectorJob' . $key, $sectorJob);
            }
            $query->andWhere(trim($filter, 'OR '));
        }

        return $query->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Artist[] Returns an array of Artist objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artist
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
