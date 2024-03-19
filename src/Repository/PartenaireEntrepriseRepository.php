<?php

namespace App\Repository;

use App\Entity\PartenaireEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PartenaireEntreprise>
 *
 * @method PartenaireEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartenaireEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartenaireEntreprise[]    findAll()
 * @method PartenaireEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenaireEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartenaireEntreprise::class);
    }

    //    /**
    //     * @return PartenaireEntreprise[] Returns an array of PartenaireEntreprise objects
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

    //    public function findOneBySomeField($value): ?PartenaireEntreprise
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
