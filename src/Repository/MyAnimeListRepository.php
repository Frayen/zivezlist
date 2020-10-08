<?php

namespace App\Repository;

use App\Entity\MyAnimeList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MyAnimeList|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyAnimeList|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyAnimeList[]    findAll()
 * @method MyAnimeList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyAnimeListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyAnimeList::class);
    }

    // /**
    //  * @return MyAnimeList[] Returns an array of MyAnimeList objects
    //  */
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
    public function findOneBySomeField($value): ?MyAnimeList
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
