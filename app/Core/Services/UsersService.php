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

    public function updateUserInfo(array $data): bool
    {
        $user = new User();
        $user->buildFromArray($data);
        return $this->usersRepository->updateUserInfo($user);
    }

    public function getUsers(): array
    {
        $data = [];
        $q = $this->usersRepository->getUsers();
        foreach ($q as $row) {
            $data[] = [
                "id" => $row["id"],
                "name" => $row['name'],
                "surname" => $row['surname'],
                "phone" => $row['phone'],
                "status" => $row['status'],
                "avatar" => $row['avatar']
            ];
        }
        return $data;
    }
}