<?php


namespace DiscoAPI\Core\ORM\Repositories;


use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\Event;

class EventsRepository
{
    private DB $db;

    private static string $table = "events";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function saveEvent(Event $event): ?int
    {
        if ($event->getId() == null) {
            $sql = "INSERT INTO " . self::$table . " SET title = ?, description = ?, poster_id = ?, air_date = ?, price = ?";
            $res = $this->db->query($sql, $event->getTitle(), $event->getDescription(), $event->getPosterId(), $event->getAirDate(), $event->getPrice());
            if ($res) {
                return $this->db->getLastInsertId();
            }
        } else {
            if ($event->getPosterId() !== null) {
                $sql = "UPDATE " . self::$table . " SET title = ?, description = ?, poster_id = ?, air_date = ?, price = ? WHERE id = ?";
                $res = $this->db->query($sql, $event->getTitle(), $event->getDescription(), $event->getPosterId(), $event->getAirDate(), $event->getPrice());
            } else {
                $sql = "UPDATE " . self::$table . " SET title = ?, description = ?, air_date = ?, price = ? WHERE id = ?";
                $res = $this->db->query($sql, $event->getTitle(), $event->getDescription(), $event->getAirDate(), $event->getPrice(), $event->getId());
            }
        }
        return $res;
    }

    public function getEvents(?int $offset = null, ?int $limit = null): ?\PDOStatement
    {
        $sql = "SELECT id, title, description, poster_id, air_date, price FROM " . self::$table . " ORDER by air_date DESC";
        if ($limit !== null) {
            if ($offset !== null) {
                $sql .= " LIMIT ?, ?";
                $res = $this->db->query($sql, $offset, $limit);
            } else {
                $sql .= " LIMIT ?";
                $res = $this->db->query($sql, $limit);
            }
        } else {
            $res = $this->db->query($sql);
        }
        if ($res) {
            return $res;
        }
        return null;
    }

    public function deleteEvent(int $id): ?\PDOStatement
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        return $this->db->query($sql, $id);
    }
}