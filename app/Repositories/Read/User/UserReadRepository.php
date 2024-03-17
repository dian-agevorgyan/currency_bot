<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use App\Services\User\Dtos\UserDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function index(): Collection
    {
        return $this->query()->get();
    }

    public function getByTelegramId(UserDto $dto, array $relations = []): ?User
    {
        return $this->query()
            ->with($relations)
            ->where('telegram_id', $dto->telegramId)
            ->first();
    }

    public function findOrFail(int $userId)
    {
        return $this->query()->findOrFail($userId);
    }
}
