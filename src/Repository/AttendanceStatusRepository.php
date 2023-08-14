<?php

namespace App\Repository;

use App\Entity\AttendanceStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttendanceStatus>
 *
 * @method AttendanceStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttendanceStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttendanceStatus[]    findAll()
 * @method AttendanceStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttendanceStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttendanceStatus::class);
    }

//    /**
//     * @return AttendanceStatus[] Returns an array of AttendanceStatus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AttendanceStatus
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
