<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\Register;
use DiscoAPI\Core\ORM\Repositories\RegistersRepository;

class RegistersService
{
    private RegistersRepository $registersRepository;

    private LoggerInterface $logger;

    private static string $registersRawJsonPath = __DIR__ . "/../../assets/common/registers.json";

    public function __construct(LoggerInterface $logger, RegistersRepository $registersRepository)
    {
        $this->logger = $logger;
        $this->registersRepository = $registersRepository;
    }

    public function updateRegister(array $data): bool
    {
        $register = new Register();
        $register->buildFromArray($data);
        return $this->registersRepository->updateRegister($register);
    }

    public function updateRegistersFile(): bool
    {
        $offset = 0;
        $limit = 20000;
        $data = [];
        do {
            $registers = $this->registersRepository->getRegisters($offset, $limit);
            foreach($registers as $rawRegister) {
                $register = new Register($rawRegister['id'], $rawRegister['name'], $rawRegister['type'], $rawRegister['status'], $rawRegister['label'], $rawRegister['ranking']);
                $data[] = [
                    'id' => $register->getId(),
                    'name' => $register->getName(),
                    'type' => $register->getType(),
                    'status' => $register->getStatus(),
                    'label' => $register->getLabel(),
                    'ranking' => $register->getRanking()
                ];
            }
            $offset += $limit;
        } while ($registers->rowCount() > 0);
        return file_put_contents(self::$registersRawJsonPath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getRegistersRaw()
    {
        if(!file_exists(self::$registersRawJsonPath)) {
            $this->updateRegistersFile();
        }
        return file_get_contents(self::$registersRawJsonPath);
    }
}