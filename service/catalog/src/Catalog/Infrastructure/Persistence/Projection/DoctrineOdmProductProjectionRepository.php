<?php

namespace App\Catalog\Infrastructure\Persistence\Projection;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use App\Catalog\Application\Projection\ProductProjection;
use App\Catalog\Application\Projection\ProductProjectionRepository;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class DoctrineOdmProductProjectionRepository extends ServiceDocumentRepository implements ProductProjectionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductProjection::class);
    }

    public function findById(string $id): ?ProductProjection
    {
        return $this->createQueryBuilder()
            ->field('id')
            ->equals($id)
            ->getQuery()
            ->getSingleResult();
    }

    public function query(array $criteria = []): array
    {
        return $this->createQueryBuilder()
            ->getQuery()
            ->execute()
            ->toArray();
    }

    public function count(array $criteria = []): int
    {
        return $this->createQueryBuilder()->count()->getQuery()->execute();
    }

    public function commit(ProductProjection $productProjection): void
    {
        $this->getDocumentManager()->persist($productProjection);
        $this->getDocumentManager()->flush();
    }

    public function remove(ProductProjection $productProjection): void
    {
        $this->getDocumentManager()->remove($productProjection);
        $this->getDocumentManager()->flush();
    }
}
