<?php

namespace App\Repository;

use App\Entity\UrlLinks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UrlLinks|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlLinks|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlLinks[]    findAll()
 * @method UrlLinks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlLinksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlLinks::class);
    }

    // /**
    //  * @return UrlLinks[] Returns an array of UrlLinks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UrlLinks
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
