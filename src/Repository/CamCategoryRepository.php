<?php

namespace App\Repository;

use App\Entity\CamCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CamCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CamCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CamCategory[]    findAll()
 * @method CamCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CamCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CamCategory::class);
    }

//    /**
//     * @return CamCategory[] Returns an array of CamCategory objects
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
    public function findOneBySomeField($value): ?CamCategory
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
