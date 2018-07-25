<?php

namespace App\Repository;

use App\Entity\Camera;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Camera|null find($id, $lockMode = null, $lockVersion = null)
 * @method Camera|null findOneBy(array $criteria, array $orderBy = null)
 * @method Camera[]    findAll()
 * @method Camera[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CameraRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Camera::class);
    }

    public function getNumber()
    {
        return $this
            ->_em
            ->createQuery('SELECT COUNT(c) t FROM App\Entity\Camera c')
            ->getResult();
    }

    public function filter($id, $manufacturer = '', $category = '')
    {
        $qb = $this->createQueryBuilder('c');

        if ($manufacturer) {
            $qb->andWhere('c.manufacturer = :manufacturer')
                ->setParameter('manufacturer', $manufacturer);
        }
        
        if ($category) {
            $qb->andWhere('c.category = :category')
                ->setParameter('category', $category);
        }

        $qb->orderBy('c.id', 'DESC')
            ->setFirstResult(($id - 1)*10)
            ->setMaxResults(10);
        
        return $qb->getQuery()->getResult();

    }

    public function filterNumber($manufacturer = '', $category = '')
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select($qb->expr()->count('c.id'))
            ->from($this->_entityName, 'c');

        if ($manufacturer) {
            $qb->andWhere('c.manufacturer = :manufacturer')
                ->setParameter('manufacturer', $manufacturer);
        }
        
        if ($category) {
            $qb->andWhere('c.category = :category')
                ->setParameter('category', $category);
        }
        
        return $qb->getQuery()->getSingleScalarResult();

    }

//    /**
//     * @return Camera[] Returns an array of Camera objects
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
    public function findOneBySomeField($value): ?Camera
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
