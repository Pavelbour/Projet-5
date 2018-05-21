<?php

namespace App\Repository;

use App\Entity\Lens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lens[]    findAll()
 * @method Lens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LensRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lens::class);
    }

//    /**
//     * @return Lens[] Returns an array of Lens objects
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
    public function findOneBySomeField($value): ?Lens
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
