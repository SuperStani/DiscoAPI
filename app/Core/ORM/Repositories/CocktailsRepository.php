<?php

namespace DiscoAPI\Core\ORM\Repositories;

use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\Cocktail;
class CocktailsRepository
{
    private DB $db;

    private static string $table = "cocktail";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function saveCocktail(Cocktail $cocktail): ?int
    {
        if ($cocktail->getId() == null) {
            $sql = "INSERT INTO " . self::$table . " SET name = ?, price = ?, quantita = ?, sconto = ?, vendite = ?, img = ?, descrizione = ?";
            $res = $this->db->query($sql, $cocktail->getName(), $cocktail->getPrice(), $cocktail->getQuantita(), $cocktail->getSconto(), $cocktail->getVendite(), $cocktail->getImg(), $cocktail->getDescrizione());
            if ($res) {
                return $this->db->getLastInsertId();
            }
        } else {
            $sql = "UPDATE " . self::$table . " SET name = ?, price = ?, quantita = ?, sconto = ?, vendite = ?, img = ?, descrizione = ? WHERE id = ?";
            $res = $this->db->query($sql, $cocktail->getName(), $cocktail->getPrice(), $cocktail->getQuantita(), $cocktail->getSconto(), $cocktail->getVendite(), $cocktail->getImg(), $cocktail->getDescrizione(), $cocktail->getId());
        }
        if($res !== null) {
            return true;
        }
        return null;
    }

    public function getCocktails(?int $offset = null, ?int $limit = null): ?\PDOStatement
    {
        $sql = "SELECT id, name, price, quantita, sconto, vendite, img, descrizione FROM " . self::$table . " ORDER by name ASC";
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
        return $res;
    }

    public function deleteCocktail(int $id): bool
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = ?";
        return $this->db->query($sql, $id) !== null;
    }
}