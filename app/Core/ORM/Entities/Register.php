<?php

namespace DiscoAPI\Core\ORM\Entities;

class Register
{
    private ?string $id;
    private ?string $name;
    private ?string $type;
    private ?int $status;
    private ?string $label;
    private ?int $ranking;

    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?string $type = null,
        ?int $status = null,
        ?string $label = null,
        ?int $ranking = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
        $this->label = $label;
        $this->ranking = $ranking;
    }

    public function buildFromArray(array $data): void
    {
        $this->setId($data['id'] ?? null);
        $this->setName($data['name'] ?? null);
        $this->setType($data['type'] ?? null);
        $this->setStatus($data['status'] ?? null);
        $this->setLabel($data['label'] ?? null);
        $this->setRanking($data['ranking'] ?? null);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function setRanking(?int $ranking): void
    {
        $this->ranking = $ranking;
    }
}