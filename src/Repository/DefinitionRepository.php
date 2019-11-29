<?php

namespace App\Repository;

use App\Entity\Definition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Definition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Definition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Definition[]    findAll()
 * @method Definition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefinitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Definition::class);
    }

    // /**
    //  * @return Definition[] Returns an array of Definition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Definition
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param int $limit
     * @return definition []
     */
    public function findLatestPublished(int $limit=10)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT a  FROM '.Definition::class.' a'
        )
            ->setMaxResults($limit)
            ->getResult();
    }
}
