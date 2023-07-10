<?php

namespace DiscoAPI\Core\ORM\Repositories;

use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\Element;

class ElementsRepository {

    private DB $db;
    private static string $table = "elements";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function updateElement(Element $element): bool
    {
        $sql = "UPDATE " . self::$table . " SET status = ? WHERE name = ?";
        return $this->db->query($sql, $element->getStatus(), $element->getName()) !== null;
    }

    public function getElements(?int $offset = null, ?int $limit = null): ?\PDOStatement
    {
        $sql = "SELECT * FROM " . self::$table;
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

}