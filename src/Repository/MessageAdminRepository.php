<?php

namespace App\Repository;

use App\Entity\MessageAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MessageAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageAdmin[]    findAll()
 * @method MessageAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageAdminRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MessageAdmin::class);
    }

    public function getNumber()
    {
        return $this
            ->_em
            ->createQuery('SELECT COUNT(m) t FROM App\Entity\MessageAdmin m')
            ->getResult();
    }

//    /**
//     * @return MessageAdmin[] Returns an array of MessageAdmin objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessageAdmin
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
