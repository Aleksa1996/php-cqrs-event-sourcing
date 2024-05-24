<?php

namespace App\Catalog\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Util\ClassUtil;
use App\Common\Domain\AggregateRoot;
use App\Common\Domain\DateTimeTracking;
use App\Common\Domain\Event\DomainEvent;

class Product extends AggregateRoot
{
    use DateTimeTracking;

    private array $images = [];

    private array $categories = [];

    private function __construct(
        Id $id,
        private string $name,
        private string $description,
        private Pid $pid,
        private Type $type,
        private Status $status = Status::IN_DEVELOPMENT,
        private ?Price $price = null,
    ) {
        parent::__construct($id);
    }

    public static function create(
        Id $id,
        string $name,
        string $description,
        Pid $pid,
        Type $type,
        Status $status = Status::IN_DEVELOPMENT,
        ?Price $price = null,
    ): self {
        $product = new Product(
            $id,
            $name,
            $description,
            $pid,
            $type,
            $status,
            $price,
        );

        $product->applyAndRecordThat(new Created(
            $id,
            $name,
            $description,
            $pid,
            $type,
            $status,
            $price,
            $product->getNextOptimisticConcurrencyVersion()
        ));

        return $product;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPid(): Pid
    {
        return $this->pid;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function changeName(string $name): DomainEvent
    {
        return $this->applyAndRecordThat(
            new NameChanged(
                $this->id,
                $name,
                $this->getNextOptimisticConcurrencyVersion()
            )
        );
    }

    public function changeDescription(string $description): DomainEvent
    {
        return $this->applyAndRecordThat(
            new DescriptionChanged(
                $this->id,
                $description,
                $this->getNextOptimisticConcurrencyVersion()
            )
        );
    }

    public function changePid(Pid $pid): DomainEvent
    {
        return $this->applyAndRecordThat(
            new PidChanged(
                $this->id,
                $pid,
                $this->getNextOptimisticConcurrencyVersion()
            )
        );
    }

    public function changePrice(Price $price): DomainEvent
    {
        return $this->applyAndRecordThat(
            new PriceChanged(
                $this->id,
                $price,
                $this->getNextOptimisticConcurrencyVersion()
            )
        );
    }

    public function changeType(Type $type): DomainEvent
    {
        return $this->applyAndRecordThat(
            new TypeChanged(
                $this->id,
                $type,
                $this->getNextOptimisticConcurrencyVersion()
            )
        );
    }

    // public function changeStatus(Status $status): void
    // {
    //     $this->applyAndRecordThat(new StatusChanged($this->id, $status));
    // }

    // public function addImage(string $name, string $description, string $src): void
    // {
    //     $this->applyAndRecordThat(new ImageAdded($this->id, $image));
    // }

    // public function removeImage(Image $image): void
    // {
    //     $this->applyAndRecordThat(new ImageRemoved($this->id, $image));
    // }

    // public function addCategory(Category $category): void
    // {
    //     $this->applyAndRecordThat(new CategoryAdded($this->id, $category));
    // }

    // public function removeCategory(Category $category): void
    // {
    //     $this->applyAndRecordThat(new CategoryRemoved($this->id, $category));
    // }

    // @phpstan-ignore-next-line
    private function applyCreated(Created $event): void
    {
        $this->id = $event->getEntityId();
        $this->name = $event->getName();
        $this->description = $event->getDescription();
        $this->pid = $event->getPid();
        $this->type = $event->getType();
        $this->status = $event->getStatus();
        $this->price = $event->getPrice();
        $this->createdOn = $event->getOccurredOn();
        $this->updatedOn = $event->getOccurredOn();
    }

    // @phpstan-ignore-next-line
    private function applyNameChanged(NameChanged $event): void
    {
        $this->name = $event->getName();
        $this->updatedOn = $event->getOccurredOn();
    }

    // @phpstan-ignore-next-line
    private function applyDescriptionChanged(DescriptionChanged $event): void
    {
        $this->description = $event->getDescription();
        $this->updatedOn = $event->getOccurredOn();
    }

    // @phpstan-ignore-next-line
    private function applyPidChanged(PidChanged $event): void
    {
        $this->pid = $event->getPid();
        $this->updatedOn = $event->getOccurredOn();
    }

    // @phpstan-ignore-next-line
    private function applyPriceChanged(PriceChanged $event): void
    {
        $this->price = $event->getPrice();
        $this->updatedOn = $event->getOccurredOn();
    }

    // @phpstan-ignore-next-line
    private function applyTypeChanged(TypeChanged $event): void
    {
        $this->type = $event->getType();
        $this->updatedOn = $event->getOccurredOn();
    }

    public static function reconstruct(array $domainEvents): Product
    {
        $product = null;

        foreach ($domainEvents as $domainEvent) {
            if ($domainEvent instanceof Created) {
                $product = new Product(
                    $domainEvent->getEntityId(),
                    $domainEvent->getName(),
                    $domainEvent->getDescription(),
                    $domainEvent->getPid(),
                    $domainEvent->getType(),
                    $domainEvent->getStatus(),
                    $domainEvent->getPrice()
                );
            }

            if (empty($product)) {
                throw new \RuntimeException('first.event.not.created');
            }

            $product->apply($domainEvent);
            $product->setOptimisticConcurrencyVersion($domainEvent->getDomainEventVersion());
        }

        return $product;
    }

    private function apply(DomainEvent $domainEvent): DomainEvent
    {
        $method = 'apply' . ClassUtil::short($domainEvent);
        call_user_func([$this, $method], $domainEvent);

        return $domainEvent;
    }

    private function applyAndRecordThat(DomainEvent $domainEvent): DomainEvent
    {
        $this->recordThat($domainEvent);

        $this->apply($domainEvent);

        return $domainEvent;
    }
}
