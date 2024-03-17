<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use App\Services\User\Dtos\UserDto;

interface UserReadRepositoryInterface
{
    public function index();

    public function getByTelegramId(UserDto $dto, array $relations = []): ?User;

    public function findOrFail(int $userId);
}
