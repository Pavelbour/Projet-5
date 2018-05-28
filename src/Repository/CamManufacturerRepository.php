<?php

namespace App\Repository;

use App\Entity\CamManufacturer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CamManufacturer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CamManufacturer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CamManufacturer[]    findAll()
 * @method CamManufacturer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CamManufacturerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CamManufacturer::class);
    }

//    /**
//     * @return CamManufacturer[] Returns an array of CamManufacturer objects
//     */
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
    public function findOneBySomeField($value): ?CamManufacturer
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
