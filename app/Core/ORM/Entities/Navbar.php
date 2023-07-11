<?php

namespace DiscoAPI\Core\ORM\Entities;

class Navbar
{
    private ?string $json;

    public function __construct(
        ?string $json
    )
    {
        $this->json = $json;
    }

    public function getJson(): ?string
    {
        return $this->json;
    }

    public function setJson(?string $json)
    {
        $this->json = $json;
    }
}