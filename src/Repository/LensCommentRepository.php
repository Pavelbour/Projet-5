<?php

namespace App\Repository;

use App\Entity\LensComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LensComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method LensComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method LensComment[]    findAll()
 * @method LensComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LensCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LensComment::class);
    }

//    /**
//     * @return LensComment[] Returns an array of LensComment objects
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
    public function findOneBySomeField($value): ?LensComment
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
