<?php

namespace App\Repository;

use App\Entity\ForumTheme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForumTheme|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumTheme|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumTheme[]    findAll()
 * @method ForumTheme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumThemeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumTheme::class);
    }

    public function getNumber($theme)
    {
        return $this
            ->_em
            ->createQuery('SELECT COUNT(th) t FROM App\Entity\ForumTheme th WHERE th.themeParent = :theme')
            ->setParameter('theme', $theme)
            ->getResult();
    }

    public function getTotalNumber()
    {
        return $this
            ->_em
            ->createQuery('SELECT COUNT(th) t FROM App\Entity\ForumTheme th')
            ->getResult();
    }

//    /**
//     * @return ForumTheme[] Returns an array of ForumTheme objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForumTheme
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
