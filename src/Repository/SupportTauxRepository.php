<?php

namespace App\Repository;

use App\Entity\SupportTaux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SupportTaux>
 *
 * @method SupportTaux|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportTaux|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportTaux[]    findAll()
 * @method SupportTaux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportTauxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupportTaux::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SupportTaux $entity, bool $flush = false): void
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
    public function remove(SupportTaux $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

  /*  *
    * @return SupportTaux[] Returns an array of SupportTaux objects
    */
   public function findAllOrderByDateFin(): array
   {
       return $this->createQueryBuilder('s')
           ->orderBy('s.finCommerce', 'DESC')
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?SupportTaux
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
