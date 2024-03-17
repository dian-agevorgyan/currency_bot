<?php

namespace App\Services\User\UseCases;

use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class GetHistoryUseCase extends AbstractBot
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository,
        protected BotTextReadRepositoryInterface $botTextReadRepository
    ) {
    }

    /**
     * @throws TeleBotException
     */
    public function run(UserDto $dto): void
    {
        $user = $this->userReadRepository->getByTelegramId($dto, ['histories']);

        if (is_null($user)) {
            $text = $this->botTextReadRepository->getBySlug('this_is_your_first_request_please_register');

            $this->sendMessage($dto->telegramId, $text);
        } else {
            $histories = "<b>История пользователя\n\n</b>";

            foreach ($user->histories as $history) {
                $histories .= "<b>ID</b>: {$history['id']}\n" .
                    "<b>User ID</b>: {$history['user_id']}\n" .
                    "<b>Message</b>: {$history['message']}\n" .
                    "<b>Message ID</b>: {$history['message_id']}\n" .
                    "<b>Created</b>: " . ($history['created_at'] ?? 'null') . "\n\n";
            }

            $this->sendMessage($dto->telegramId, $histories, 'HTML');
        }
    }
}
