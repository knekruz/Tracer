<?php

namespace App\Repository;

use App\Entity\Recherche;
use App\Entity\Support;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Support>
 *
 * @method Support|null find($id, $lockMode = null, $lockVersion = null)
 * @method Support|null findOneBy(array $criteria, array $orderBy = null)
 * @method Support[]    findAll()
 * @method Support[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Support::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Support $entity, bool $flush = false): void
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
    public function remove(Support $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByElement(Recherche $recherche)
    {
        $query = $this->getQueryBuilder();

        if ($recherche->getRecherche()) {
            $query
                ->where('p.isin LIKE :re')
                ->orWhere('p.nom LIKE :re')
                ->orWhere('categories.nom LIKE :re')
                ->orWhere('emetteur.nom LIKE :re')
                ->orWhere('emetteur.prenom LIKE :re')
                ->orWhere('emetteur.email LIKE :re')
                ->setParameter('re', '%' . $recherche->getRecherche() . '%');
        }

        return $query->getQuery()->getResult();
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->join('p.categories', 'categories')
            ->join('p.emetteur', 'emetteur');
    }

    public function getFrais()
    {
        $query = $this->getQueryBuilder();

        return $this->createQueryBuilder('p')
            ->join('p.categories', 'categories')
            ->join('p.emetteur', 'emetteur');
    }
}
