<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\Navbar;

class NavbarService
{
    private LoggerInterface $logger;

    private static string $navbarJsonPath = __DIR__ . "/../../assets/common/navbar.json";

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function updateNavbarJson(string $json): bool
    {
        $navbar = new Navbar($json);
        $write = file_put_contents(self::$navbarJsonPath, $navbar->getJson());
        if($write) {
            return true;
        }
        $this->logger->error('Update navbar failed', $json);
        return false;
    }

    /**
     * @return false|string
     */
    public function getNavbarJson()
    {
        return file_get_contents(self::$navbarJsonPath);
    }
}