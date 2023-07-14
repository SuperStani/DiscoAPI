<?php

namespace DiscoAPI\Core\ORM\Repositories;

use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\User;

class UsersRepository
{
    private DB $db;
    private static string $table = "users";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function updateUserStatus(User $user): bool
    {
        $sql = "UPDATE " . self::$table . " SET status = ? WHERE id = ?";
        return $this->db->query($sql, $user->getStatus(), $user->getId()) !== null;
    }

    public function getUsers(?int $offset = null, ?int $limit = null): ?\PDOStatement
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