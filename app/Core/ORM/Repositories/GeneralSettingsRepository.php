<?php

namespace DiscoAPI\Core\ORM\Repositories;

use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\GeneralSettings;

class GeneralSettingsRepository {

    private DB $db;

    private static string $table = "settings";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function updateSettings(GeneralSettings $settings): \PDOStatement
    {
        $sql = 'UPDATE '. self::$table . ' SET logo = ?, size = ?, facebook = ?, instagram = ?, twitter = ?, telegram = ?, whatsapp = ?, cell = ?, email = ?, address = ?, pec = ?'; //Non so se devo mettere un WHERE qua
        return $this->db->query($sql, $settings->getLogo(), $settings->getSize(), $settings->getFacebook(), $settings->getInstagram(), $settings->getTwitter(), $settings->getTelegram(), $settings->getWhatsapp(), $settings->getCell(), $settings->getEmail(), $settings->getAddress(), $settings->getPec());
    }

    public function getSettings(): ?\PDOStatement
    {
        $sql = 'SELECT logo, size, facebook, instagram, twitter, telegram, whatsapp, cell, email FROM ' . self::$table; //Non so se devo mettere un WHERE qua
        return $this->db->query($sql); 
    }

}