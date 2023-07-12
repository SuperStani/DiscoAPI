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

    public function __construct(
        ?string $logo = null,
        ?string $size = null,
        ?string $facebook = null,
        ?string $instagram = null,
        ?string $twitter = null,
        ?string $telegram = null,
        ?string $whatsapp = null,
        ?string $cell = null,
        ?string $email = null
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

    //SET

    public function setLogo(): void
    {
        $this->logo = $logo;
    }

    public function setSize(): void
    {
        $this->logo = $size;
    }

    public function setFacebook(): void
    {
        $this->logo = $facebook;
    }

    public function setInstagram(): void
    {
        $this->logo = $instagram;
    }

    public function setTwitter(): void
    {
        $this->logo = $twitter;
    }

    public function setTelegram(): void
    {
        $this->logo = $telegram;
    }

    public function setWhatsapp(): void
    {
        $this->logo = $whatsapp;
    }

    public function setCell(): void
    {
        $this->logo = $cell;
    }

    public function setEmail(): void
    {
        $this->logo = $email;
    }

}