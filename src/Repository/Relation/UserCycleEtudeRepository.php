<?php

namespace App\Repository\Relation;

use App\Entity\Relation\UserCycleEtude;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserCycleEtude>
 *
 * @method UserCycleEtude|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCycleEtude|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCycleEtude[]    findAll()
 * @method UserCycleEtude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCycleEtudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCycleEtude::class);
    }

    public function save(UserCycleEtude $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserCycleEtude $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UserCycleEtude[] Returns an array of UserCycleEtude objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserCycleEtude
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
