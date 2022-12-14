<?php

namespace App\Repository;

use App\Entity\SupportInvestissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SupportInvestissement>
 *
 * @method SupportInvestissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportInvestissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportInvestissement[]    findAll()
 * @method SupportInvestissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportInvestissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportInvestissement::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SupportInvestissement $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(SupportInvestissement $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return SupportInvestissement[] Returns an array of SupportInvestissement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SupportInvestissement
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
