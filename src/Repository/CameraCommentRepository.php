<?php

namespace App\Repository;

use App\Entity\CameraComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CameraComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CameraComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CameraComment[]    findAll()
 * @method CameraComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CameraCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CameraComment::class);
    }

//    /**
//     * @return CameraComment[] Returns an array of CameraComment objects
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
    public function findOneBySomeField($value): ?CameraComment
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
