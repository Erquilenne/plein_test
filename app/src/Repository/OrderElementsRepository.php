<?php

namespace App\Repository;

use App\Entity\OrderElements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderElements|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderElements|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderElements[]    findAll()
 * @method OrderElements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderElementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderElements::class);
    }

    // /**
    //  * @return OrderElements[] Returns an array of OrderElements objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderElements
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
