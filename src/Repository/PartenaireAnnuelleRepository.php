<?php

namespace App\Repository;

use App\Entity\PartenaireAnnuelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PartenaireAnnuelle>
 *
 * @method PartenaireAnnuelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartenaireAnnuelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartenaireAnnuelle[]    findAll()
 * @method PartenaireAnnuelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireAnnuelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartenaireAnnuelle::class);
    }

    //    /**
    //     * @return PartenaireAnnuelle[] Returns an array of PartenaireAnnuelle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PartenaireAnnuelle
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
