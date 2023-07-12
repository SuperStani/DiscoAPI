<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Configs\GeneralConfigurations;
use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\GeneralSettings;
use DiscoAPI\Core\ORM\Repositories\GeneralSettingsRepository;

class GeneralSettingsService {

    private GeneralSettingsRepository $generalSettingsRepository;

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, GeneralSettingsRepository $generalSettingsRepository)
    {
        $this->logger = $logger;
        $this->generalSettingsRepository = $generalSettingsRepository;
    }

    public function saveSettings(array $data): ?int
    {
        $settings = new Settings();
        $settings->setLogo($data['logo']);
        $settings->setSize($data['size']);
        $settings->setFacebook($data['facebook']);
        $settings->setInstagram($data['instagram']);
        $settings->setTwitter($data['twitter']);
        $settings->setTelegram($data['telegram']);
        $settings->setWhatsapp($data['whatsapp']);
        $settings->setCell($data['cell']);
        $settings->setEmail($data['email']);
        return $this->generalSettingsRepository->saveSettings($settings);
    }

}