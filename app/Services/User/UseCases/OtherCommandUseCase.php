<?php

namespace App\Services\User\UseCases;

use App\Repositories\Read\BotText\BotTextReadRepositoryInterface;
use App\Services\User\Dtos\UserDto;
use WeStacks\TeleBot\Exceptions\TeleBotException;

class OtherCommandUseCase extends AbstractBot
{
    public function __construct(
        protected BotTextReadRepositoryInterface $botTextReadRepository
    ) {
    }

    /**
     * @throws TeleBotException
     */
    public function run(UserDto $dto): void
    {
        $text = $this->botTextReadRepository->getBySlug('try_another_command')->text;
        $this->sendMessage($dto->telegramId, $text);
    }
}
