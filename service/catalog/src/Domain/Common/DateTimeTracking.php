<?php

namespace App\Domain\Common;

trait DateTimeTracking
{
    protected \DateTimeImmutable $createdOn;

    protected \DateTimeImmutable $updatedOn;

    public function getCreatedOn(): \DateTimeImmutable
    {
        return $this->createdOn;
    }

    protected function setCreatedOn(\DateTimeImmutable $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getUpdatedOn(): \DateTimeImmutable
    {
        return $this->updatedOn;
    }

    protected function setUpdatedOn(\DateTimeImmutable $updatedOn): self
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }
}
