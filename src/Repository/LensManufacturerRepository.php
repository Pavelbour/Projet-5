<?php

namespace App\Repository;

use App\Entity\LensManufacturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LensManufacturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method LensManufacturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method LensManufacturer[]    findAll()
 * @method LensManufacturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LensManufacturerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LensManufacturer::class);
    }

//    /**
//     * @return LensManufacturer[] Returns an array of LensManufacturer objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LensManufacturer
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
