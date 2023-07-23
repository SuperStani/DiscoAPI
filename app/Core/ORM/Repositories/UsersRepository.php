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

    public function updateUserInfo(User $user): bool
    {
        $sql = "UPDATE " . self::$table . " SET name = ?, surname = ?, phone = ?, avatar = ?, status = ? WHERE id = ?";
        return $this->db->query($sql, $user->getName(), $user->getSurname(), $user->getPhone(), $user->getAvatar(), $user->getStatus(), $user->getId()) !== null;
    }

    public function getUsers(?int $offset = null, ?int $limit = null): ?\PDOStatement
    {
        $sql1 = "SELECT REPLACE(GROUP_CONCAT(COLUMN_NAME), 'password,', '') 
FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".self::$table."' 
AND TABLE_SCHEMA = 'nightclub' ";
        $res1 = $this->db->query($sql1);
        $sql = "SELECT ".$res1->fetchColumn()." FROM " . self::$table;
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