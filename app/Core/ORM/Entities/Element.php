<?php

namespace DiscoAPI\Core\ORM\Entities;

class Element
{
    private ?int $id;
    private ?string $name;
    private ?int $status;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?int $status = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }

    public function buildFromArray(array $data): void
    {
        $this->setId($data['id'] ?? null);
        $this->setName($data['name'] ?? null);
        $this->setStatus($data['status'] ?? null);
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }
}