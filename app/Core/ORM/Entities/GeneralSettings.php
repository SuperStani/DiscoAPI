<?php

namespace DiscoAPI\Core\ORM\Entities;

class Settings {
    
    private ?string $logo;
    private ?string $size;
    private ?string $facebook;
    private ?string $instagram;
    private ?string $twitter;
    private ?string $telegram;
    private ?string $whatsapp;
    private ?string $cell;
    private ?string $email;
    private ?string $address;
    private ?string $pec;

    public function __construct(
        ?string $logo = null,
        ?string $size = null,
        ?string $facebook = null,
        ?string $instagram = null,
        ?string $twitter = null,
        ?string $telegram = null,
        ?string $whatsapp = null,
        ?string $cell = null,
        ?string $email = null,
        ?string $address = null,
        ?string $pec = null
    )
    {
        $this->logo = $logo;
        $this->size = $size;
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->twitter = $twitter;
        $this->telegram = $telegram;
        $this->whatsapp = $whatsapp;
        $this->cell = $cell;
        $this->email = $email;
        $this->address = $address;
        $this->pec = $pec;
    }

    //GET

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    public function getCell(): ?string
    {
        return $this->cell;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPec(): ?string
    {
        return $this->pec;
    }

    //SET

    public function setLogo(): void
    {
        $this->logo = $logo;
    }

    public function setSize(): void
    {
        $this->size = $size;
    }

    public function setFacebook(): void
    {
        $this->facebook = $facebook;
    }

    public function setInstagram(): void
    {
        $this->instagram = $instagram;
    }

    public function setTwitter(): void
    {
        $this->twitter = $twitter;
    }

    public function setTelegram(): void
    {
        $this->telegram = $telegram;
    }

    public function setWhatsapp(): void
    {
        $this->whatsapp = $whatsapp;
    }

    public function setCell(): void
    {
        $this->cell = $cell;
    }

    public function setEmail(): void
    {
        $this->email = $email;
    }

    public function setAddress(): void
    {
        $this->address = $address;
    }

    public function setPec(): void
    {
        $this->pec = $pec;
    }

}