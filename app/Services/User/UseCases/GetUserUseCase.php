<?php

namespace App\Services\User\UseCases;

use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class GetUserUseCase extends AbstractBot
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
        $users = $this->userReadRepository->index();

        $text = "<b>Информация о пользователях\n\n</b>";

        foreach ($users as $user) {
            $text .=
                "<b>ID</b>: {$user['id']}\n" .
                "<b>Name</b>: {$user['first_name']} {$user['last_name']}\n" .
                "<b>Telegram ID</b>: {$user['telegram_id']}\n" .
                "<b>Username</b>: @{$user['telegram_username']}\n" .
                "<b>Language</b>: {$user['language_code']}\n" .
                "<b>Created At</b>: {$user['created_at']}\n\n";
        }

        $this->sendMessage($dto->telegramId, $text, 'HTML');
    }
}
