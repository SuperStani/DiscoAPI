<?php

namespace DiscoApi\Core\ORM\Repositories;

use DiscoAPI\Core\ORM\DB;
use DiscoAPI\Core\ORM\Entities\GeneralSettings\Settings;

class GeneralSettingsRepository {

    private DB $db;

    private static string $table = "settings";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function updateSettings(Settings $settings): ?int
    {
        $sql = 'UPDATE '. self::$table . 'SET logo = ?, size = ?, facebook = ?, instagram = ?, twitter = ?, telegram = ?, whatsapp = ?, cell = ?, email = ?'; //Non so se devo mettere un WHERE qua
        return $this->db->query($sql, $settings['logo'], $settings['size'], $settings['facebook'], $settings['instagram'], $settings['twitter'], $settings['telegram'], $settings['whatsapp'], $settings['cell'], $settings['email']);
    }

    public function clearSettings(): ?int //Resetta tutte le impostazioni, non so quanto sia utile :/
    {
        $sql = 'UPDATE '. self::$table . 'SET logo = ?, size = ?, facebook = ?, instagram = ?, twitter = ?, telegram = ?, whatsapp = ?, cell = ?, email = ?'; //Non so se devo mettere un WHERE qua
        return $this->db->query($sql, null, null, null, null, null, null, null, null, null);
    }

    public function getSettings(): ?\PDOStatement
    {
        $sql = 'SELECT logo, size, facebook, instagram, twitter, telegram, whatsapp, cell, email FROM ' . self::$table; //Non so se devo mettere un WHERE qua
        return $this->db->query($sql); 
    }

}