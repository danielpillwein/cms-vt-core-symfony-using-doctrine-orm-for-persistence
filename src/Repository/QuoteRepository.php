<?php

namespace App\Repository;

use App\Entity\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quote>
 *
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quote::class);
    }

    public function findBySearchTerm($searchTerm)
    {
        return $this->createQueryBuilder('quote')
            ->leftJoin('quote.movie', 'movie')
            ->where('quote.quote LIKE :searchTerm')
            ->orWhere('quote.character LIKE :searchTerm')
            ->orWhere('movie.name LIKE :searchTerm')
            ->orWhere('movie.releaseYear LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();
    }

    public function getRandom()
    {
        $qb = $this->createQueryBuilder('quote');

        $count = $qb->select('COUNT(quote.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $randomOffset = mt_rand(0, $count - 1);

        return $qb->select('quote')
            ->setFirstResult($randomOffset)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('quote')
            ->leftJoin('quote.movie', 'movie')
            ->orderBy('movie.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Quote[] Returns an array of Quote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Quote
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
