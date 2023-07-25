<?php

namespace DiscoAPI\Core\ORM\Entities;

class Cocktail
{
    private ?int $id;
    private ?string $name;
    private ?float $price;
    private ?int $quantita;
    private ?float $sconto;
    private ?int $vendite;
    private ?string $img;
    private ?string $descrizione;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param float|null $price
     * @param int|null $quantita
     * @param float|null $sconto
     * @param int|null $vendite
     * @param string|null $img
     * @param string|null $descrizione
     */
    public function __construct(?int $id = null, ?string $name = null, ?float $price = null, ?int $quantita = null, ?float $sconto = null, ?int $vendite = null, ?string $img = null, ?string $descrizione = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantita = $quantita;
        $this->sconto = $sconto;
        $this->vendite = $vendite;
        $this->img = $img;
        $this->descrizione = $descrizione;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     */
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getQuantita(): ?int
    {
        return $this->quantita;
    }

    /**
     * @param int|null $quantita
     */
    public function setQuantita(?int $quantita): void
    {
        $this->quantita = $quantita;
    }

    /**
     * @return float|null
     */
    public function getSconto(): ?float
    {
        return $this->sconto;
    }

    /**
     * @param float|null $sconto
     */
    public function setSconto(?float $sconto): void
    {
        $this->sconto = $sconto;
    }

    /**
     * @return int|null
     */
    public function getVendite(): ?int
    {
        return $this->vendite;
    }

    /**
     * @param int|null $vendite
     */
    public function setVendite(?int $vendite): void
    {
        $this->vendite = $vendite;
    }

    /**
     * @return string|null
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @param string|null $img
     */
    public function setImg(?string $img): void
    {
        $this->img = $img;
    }

    /**
     * @return string|null
     */
    public function getDescrizione(): ?string
    {
        return $this->descrizione;
    }

    /**
     * @param string|null $descrizione
     */
    public function setDescrizione(?string $descrizione): void
    {
        $this->descrizione = $descrizione;
    }


}