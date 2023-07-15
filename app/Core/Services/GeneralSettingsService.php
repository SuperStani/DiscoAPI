<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\GeneralSettings;
use DiscoAPI\Core\ORM\Repositories\GeneralSettingsRepository;

class GeneralSettingsService {

    private GeneralSettingsRepository $generalSettingsRepository;

    private LoggerInterface $logger;

    private static string $settingsRawJsonPath = __DIR__ . "/../../assets/common/settings.json";

    public function __construct(LoggerInterface $logger, GeneralSettingsRepository $generalSettingsRepository)
    {
        $this->logger = $logger;
        $this->generalSettingsRepository = $generalSettingsRepository;
    }

    public function updateSettings(array $data): \PDOStatement
    {
        $settings = new GeneralSettings();
        $settings->setLogo($data['logo']);
        $settings->setSize($data['size']);
        $settings->setFacebook($data['facebook']);
        $settings->setInstagram($data['instagram']);
        $settings->setTwitter($data['twitter']);
        $settings->setTelegram($data['telegram']);
        $settings->setWhatsapp($data['whatsapp']);
        $settings->setCell($data['cell']);
        $settings->setEmail($data['email']);
        $settings->setAddress($data['address']);
        $settings->setPec($data['pec']);
        return $this->generalSettingsRepository->updateSettings($settings);
    }

    public function getSettingsRaw()
    {
        return file_get_contents(self::$settingsRawJsonPath);
    }

}