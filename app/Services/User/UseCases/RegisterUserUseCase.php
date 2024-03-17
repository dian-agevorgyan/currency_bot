<?php

namespace App\Services\User\UseCases;

use App\Models\Histories;
use App\Models\User;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use Illuminate\Support\Facades\DB;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class RegisterUserUseCase extends AbstractBot
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    /**
     * @throws TeleBotException
     */
    public function run(UserDto $dto): void
    {
        $user = $this->userReadRepository->getByTelegramId($dto);

        if (!is_null($user)) {
            $text = 'Вы уже зарегистрированы';
            $this->sendMessage($dto->telegramId, $text);

            return;
        }

        DB::transaction(function () use ($dto) {
            $user = User::staticCreate($dto);
            $user->save();

            $history = Histories::staticCreate($dto, $user->id);
            $history->save();
        });

        $text = 'Вы зарегистрированы';
        $this->sendMessage($dto->telegramId, $text);
    }
}
