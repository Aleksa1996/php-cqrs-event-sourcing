<?php

namespace App\Infrastructure\Persistence\EventStore;

use App\Domain\Common\Id;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Infrastructure\Persistence\Doctrine\Type\IdType;

#[ORM\Entity]
#[ORM\Table(name: 'event_store')]
class StoredDomainEvent
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    public function __construct(
        #[ORM\Column(type: IdType::NAME)]
        private readonly Id $entityId,
        #[ORM\Column(type: Types::INTEGER)]
        private readonly int $version,
        #[ORM\Column(type: Types::STRING, length: 300)]
        private readonly string $type,
        #[ORM\Column(type: Types::TEXT)]
        private readonly string $body,
        #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
        private readonly \DateTimeImmutable $occurredOn
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getEntityId(): Id
    {
        return $this->entityId;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
