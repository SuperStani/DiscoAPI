<?php

namespace DiscoAPI\Core\Services;

use DiscoAPI\Core\Logger\LoggerInterface;
use DiscoAPI\Core\ORM\Entities\User;
use DiscoAPI\Core\ORM\Repositories\UsersRepository;

class UsersService
{
    private UsersRepository $usersRepository;

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, UsersRepository $usersRepository)
    {
        $this->logger = $logger;
        $this->usersRepository = $usersRepository;
    }

    public function updateUserStatus(array $data): bool
    {
        $user = new User();
        $user->buildFromArray($data);
        return $this->usersRepository->updateUserStatus($user);
    }

    /**
     * @return array|false
     */
    public function getUsers()
    {
        $q = $this->usersRepository->getUsers();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
}