<?php

namespace App\Repository;

use App\Entity\TimeAttendance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TimeAttendance>
 *
 * @method TimeAttendance|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeAttendance|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeAttendance[]    findAll()
 * @method TimeAttendance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeAttendaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimeAttendance::class);
    }

//    /**
//     * @return TimeAttendance[] Returns an array of TimeAttendance objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TimeAttendance
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
