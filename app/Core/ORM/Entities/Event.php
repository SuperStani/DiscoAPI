<?php


namespace DiscoAPI\Core\ORM\Entities;


class Event
{
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $airDate;
    private ?string $posterId;
    private ?string $price;

    public function __construct(
        ?int $id = null,
        ?string $title = null,
        ?string $description = null,
        ?string $airDate = null,
        ?string $posterPath = null,
        ?string $price = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->airDate = $airDate;
        $this->posterId = $posterPath;
        $this->price = $price;
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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getAirDate(): ?string
    {
        return $this->airDate;
    }

    /**
     * @param string|null $airDate
     */
    public function setAirDate(?string $airDate): void
    {
        $this->airDate = $airDate;
    }

    /**
     * @return string|null
     */
    public function getPosterId(): ?string
    {
        return $this->posterId;
    }

    /**
     * @param string|null $posterId
     */
    public function setPosterId(?string $posterId): void
    {
        $this->posterId = $posterId;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     */
    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }
}