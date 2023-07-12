<?php

namespace DiscoAPI\Core\ORM\Repositories;

use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\Register;

class RegistersRepository
{
    private DB $db;
    private static string $table = "register";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function updateRegister(Register $register): bool
    {
        $sql = "UPDATE " . self::$table . " SET status = ? WHERE id = ?";
        return $this->db->query($sql, $register->getStatus(), $register->getId()) !== null;
    }

    public function getRegisters(?int $offset = null, ?int $limit = null): ?\PDOStatement
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