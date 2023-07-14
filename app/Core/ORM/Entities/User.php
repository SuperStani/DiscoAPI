<?php

namespace DiscoAPI\Core\ORM\Entities;

class User
{
    private ?int $id;
    private ?string $name;
    private ?string $surname;
    private ?string $phone;
    private ?string $password;
    private ?string $avatar;
    private ?int $status;

    public function __construct(
        ?int $id = null,
        ?string $name = null,
        ?string $surname = null,
        ?string $phone = null,
        ?string $password = null,
        ?string $avatar = null,
        ?int $status = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->status = $status;

    }

    public function buildFromArray(array $data): void
    {
        $this->setId($data['id'] ?? null);
        $this->setName($data['name'] ?? null);
        $this->setSurname($data['surname'] ?? null);
        $this->setPhone($data['phone'] ?? null);
        $this->setPassword($data['password'] ?? null);
        $this->setAvatar($data['avatar'] ?? null);
        $this->setStatus($data['status'] ?? null);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setId(?id $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }
}