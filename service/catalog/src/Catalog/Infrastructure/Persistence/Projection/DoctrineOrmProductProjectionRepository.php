<?php

namespace App\Catalog\Infrastructure\Persistence\Projection;

use Doctrine\Persistence\ManagerRegistry;
use App\Catalog\Application\Projection\ProductProjection;
use App\Catalog\Application\Projection\ProductProjectionRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineOrmProductProjectionRepository extends ServiceEntityRepository implements ProductProjectionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductProjection::class);
    }

    public function findById(string $id): ?ProductProjection
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT p FROM App\Catalog\Application\Projection\ProductProjection p WHERE p.id = :id')
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }

    public function query(array $criteria = []): array
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT p FROM App\Catalog\Application\Projection\ProductProjection p')
            ->getResult();
    }

    public function count(array $criteria = []): int
    {
        return $this
            ->getEntityManager()
            ->createQuery('SELECT COUNT(p) FROM App\Catalog\Application\Projection\ProductProjection p')
            ->getResult();
    }

    public function commit(ProductProjection $productProjection): void
    {
        $this->getEntityManager()->persist($productProjection);
        $this->getEntityManager()->flush();
    }

    public function remove(ProductProjection $productProjection): void
    {
        $this->getEntityManager()->remove($productProjection);
        $this->getEntityManager()->flush();
    }
}
